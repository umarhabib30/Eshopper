<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
            $credentials = $request->only('email','password');
            $remember = $request->remember=='on' ? true:false;
            if(Auth::guard('admin')->attempt($credentials,$remember))
            {
                return redirect()->route('admin.index');
            }
            else
            return redirect()->back();
    }

    public function logout()
    {
        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    }
}
