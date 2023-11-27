<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Transaction\TransactionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use function view;

class UserController extends Controller
{

    public $transaction;
    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function login_user(Request $request)
    {
        if (!empty($request->email) && (!empty($request->password))) {
            if (auth()->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ], true)) {
                return redirect()->route('user.dashboard.index');
            }
        }

        if (auth()->check()) {
            if (optional(auth()->user())->is_admin == 0) return view('auth.login');
        }
        return view('publisher.pages.sign-in');
    }

    public function postLoginUser(Request $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember)) {
            if (optional(auth()->user())->is_admin == 0) return view('user.dashboard.index');
        }

        Session::flash("message", "Sai tài khoản hoặc mật khẩu");
        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function password()
    {
        $title = "Change password";
        return view('user.password.index', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_confirm' => 'required',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            Session::flash("error", "Old password not correct");
            return back();
        }

        if ($request->new_password != $request->new_password_confirm) {
            Session::flash("error", "New password must match");
            return back();
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        Session::flash("success", "Changed password");

        return back();
    }

    public function showSignUpReferral($code)
    {
        $data['code'] = $code;
        return view('publisher.pages.sign-up', $data);
    }

    public function indexReferral(Request $request)
    {
        $request = $request->all();
        $params = [
          'user_id' => Auth::user()->id,
          'from' => $request['from'] ?? null,
          'to' => $request['to'] ?? null,
        ];

        $data = [
            'items' => $this->transaction->listReferPublisherByDate($params)
        ];
        return view('publisher.referrals.index', $data);
    }

}
