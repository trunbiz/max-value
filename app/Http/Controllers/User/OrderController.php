<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Helper;
use App\Models\Order;
use App\Models\Product;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Order $model)
    {
       $this->initBaseModel($model);
       $this->shareBaseModel($model);
    }

    public function index(Request $request){
        if(Session::get('cart')){
            $title = 'Thanh toán';
            $categories = Category::all();

            return view('user.' . $this->prefixView . '.index')->with(compact('categories', 'title'));
        }else{
            return redirect()->back();
        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
        ], [
            'name.required' => 'Bạn chưa điền tên',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.number' => 'Số điện thoại chỉ nhận giá trị là số',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không đúng định dạng',
            'address.required' => 'Bạn chưa điền địa chỉ',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $item = $this->model->storeByQuery($request);
            Session::forget('cart');
            return response()->json([
                'status' => true,
                'message' => 'Đặt hàng thành công! Cảm ơn bạn đã đặt hàng tại web của chúng tôi',
            ]);
        }
    }

    //Cart

    public function add_to_cart(Request $request){
        $cart = Session::get('cart');
        $data = Product::find($request->id);

        if(isset($cart) && !empty($cart)){
            $is_avalable = 0;
            foreach($cart as $key => $val){
                if($cart[$key]['product_id'] == $request->id){
                   $cart[$key]['quantity']++;
                   $is_avalable++;
                }
            }
            Session::put('cart', $cart);

            if($is_avalable == 0){
                $cart[] = array(
                    'product_id' => $data['id'],
                    'product_name' => $data['name'],
                    'product_image' => $data['image_url'],
                    'product_url' => $data['slug'],
                    'product_sku' => $data['sku'],
                    'price' => $data['sell_price'],
                    'quantity' => 1,
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'product_id' => $data['id'],
                'product_name' => $data['name'],
                'product_image' => $data['image_url'],
                'product_url' => $data['slug'],
                'product_sku' => $data['sku'],
                'price' => $data['sell_price'],
                'quantity' => 1,
            );
            Session::put('cart', $cart);
        }
        Session::save();

        return response()->json([
            'status' => true,
            'message' => 'Thêm thành công',
            'count' => count($cart),
            'show' => view('user.components.popup_cart')->with(compact('cart'))->render(),
        ]);
    }

    public function cart(){
        $title = 'Giỏ hàng';
        $categories = Category::all();
        return view('user.cart.index')->with(compact('title', 'categories'));
    }

    function updateCart(Request $request){
        $title = 'Giỏ hàng';
        $products = Product::all();
        $cart = Session::get('cart');
        if(isset($cart) && !empty($cart)){
            foreach($cart as $key => $value){
                if($cart[$key]['product_id'] == $request->id){
                    $cart[$key]['quantity'] = $request->quantity;
                }
            }
            Session::put('cart', $cart);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công',
                'count' => count($cart),
                'html' => view('user.cart.data_cart')->with(compact('cart', 'products', 'title'))->render(),
                'show' => view('user.components.popup_cart')->with(compact('cart'))->render(),
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Cập nhật không thành công',
            ]);
        }
    }

    public function deleteItem(Request $request){
        $title = 'Giỏ hàng';
        $products = Product::all();
        $cart = Session::get('cart');
        if(isset($cart) && !empty($cart)){
            foreach($cart as $key => $val){
                if($cart[$key]['product_id'] == $request->id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return response()->json([
                'status' => true,
                'message' => 'Xoá thành công',
                'count' => count($cart),
                'html' => view('user.cart.data_cart')->with(compact('cart', 'products', 'title'))->render(),
                'show' => view('user.components.popup_cart')->with(compact('cart'))->render(),
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Xoá không thành công',
            ]);
        }
    }

    public function deleteAll(){
        $title = 'Giỏ hàng';
        $cart = Session::get('cart');
        if(isset($cart) && !empty($cart)){
            Session::forget('cart');
            $cart = '';
            return response()->json([
                'status' => true,
                'message' => 'Xoá thành công',
                'count' => 0,
                'html' => view('user.cart.data_cart')->with(compact('title'))->render(),
                'show' => view('user.components.popup_cart')->with(compact('cart'))->render(),
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Xoá không thành công',
            ]);
        }
    }

    public function removeItem(Request $request){
        $title = 'Giỏ hàng';
        $products = Product::all();
        $cart = Session::get('cart');
        if(isset($cart) && !empty($cart)){
            foreach($cart as $key => $val){
                if($cart[$key]['product_id'] == $request->id){
                    unset($cart[$key]);
                }
            }

            return response()->json([
                'status' => true,
                'html' => view('user.cart.data_cart')->with(compact('cart', 'products', 'title'))->render()
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Xoá không thành công',
            ]);
        }
    }

    //End cart
}
