<?php

namespace NSO\Backend\Controllers;

use Illuminate\Support\Facades\Auth;
use NSO\Backend\Requests\LoginRequest;

class LoginController
{
    public function index()
    {
        return view('backend::auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $remmember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remmember)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()
            ->back()
            ->with([
                'error' => 'Thông tin tài khoản không đúng.'
            ])
            ->withInput($credentials);
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
