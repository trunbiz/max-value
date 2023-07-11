<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class LoginController extends Controller
{

    public function indexLogin()
    {
        $title = 'Đăng nhập';
        if(Auth::check()){
            return redirect()->route('user.home.index');
        }
        return view('user.login.index')->with(compact('title'));
    }

    public function postLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric',
            'password' => 'required',
        ], [
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.number' => 'Số điện thoại chỉ nhận giá trị là số',
            'password.required' => 'Bạn chưa điền mật khẩu',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            if(auth()->attempt([
                'phone' => $request->phone,
                'password' => $request->password,
            ])){
                if(optional(auth()->user())->is_admin == 0){
                    return response()->json([
                        'status' => true,
                        'message' => 'Đăng nhập thành công',
                    ]);
                }
            }

            return response()->json([
                'status' => false,
                'message' => 'Sai tài khoản hoặc mật khẩu',
            ]);
        }
    }

    public function indexRegister(){
        $title = 'Đăng ký';

        if(Auth::check()){
            return redirect()->route('user.home.index');
        }

        return view('user.register.index')->with(compact('title'));
    }

    public function postRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'name' => 'required',
        ], [
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.number' => 'Số điện thoại chỉ nhận giá trị là số',
            'phone.unique' => 'Số điện thoại đã được đăng ký, vui lòng nhập số khác',
            'password.required' => 'Bạn chưa điền mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập lại không khớp, vui lòng nhập lại',
            'name.required' => 'Bạn chưa nhập tên',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role_id' => 0,
            ]);

            Auth::login($user);

            return response()->json([
                'status' => true,
                'message' => 'Đăng ký thành công',
            ]);
        }
    }

    public function logoutUser(){
       Auth::logout();
       return redirect()->route('user.home.index');
    }
}
