<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class SettingController extends Controller
{
    public function index(){
        $title = 'Setting';

        $current_user = User::where('id', Auth::id())->first();

        return view('user.setting.index')->with(compact('title', 'current_user'));
    }

    public function update_profile(Request $request){
        $data = $request->all();
//        $firstname = $data['firstname'];
//        $lastname = $data['lastname'];
        $email = $data['email'];
        $birth = str_replace('/', '-', $data['birth']);
        $address = $data['address'];
        $validator = Validator::make($request->all(), [
//            'firstname' => 'required|string',
//            'lastname' => 'required|string',
            'email' => 'email',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $update = User::where('id', Auth::id())->update([
//                'name' => $firstname.' '.$lastname,
                'email' => $email,
                'date_of_birth' => date('Y-m-d', strtotime($birth)),
                'address' => $address,
            ]);

            if($update){
                return response()->json([
                    'status' => true,
                    'message' => 'Update Successful',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Error',
                ]);
            }
        }
    }

    public function update_pass(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'current_password' => [
              'required', function($attr, $value, $fail){
                    if(!Hash::check($value, Auth::user()->password)){
                        $fail('Old password not correct');
                    }
                }
            ],
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $update = User::where('id', Auth::id())->update([
               'password' => Hash::make($data['new_password']),
            ]);
            if($update){
                return response()->json([
                    'status' => true,
                    'message' => 'Update Successful! Please login again to continue!',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Error',
                ]);
            }
        }

    }

}
