<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (!Auth::check()) {
            //echo Auth::check();
            return view('admin.module.login.login');
        } else {
            return redirect('admin');
        }
    }

    public function postLogin(LoginRequest $request)
    {
        $login = [
            'username' => $request->input('txtUser'),
            'password' => $request->input('txtPass'),
            'level' => 1
        ];
        if (Auth::attempt($login)) {
            return redirect('admin');

        } else {
            $errors = "Tên đăng nhập hoặc mật khẩu sai!";
            //return redirect()->back()->withErrors($errors);
            return redirect('login')->withErrors($errors);
        }

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
