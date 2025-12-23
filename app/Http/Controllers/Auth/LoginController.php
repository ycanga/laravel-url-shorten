<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // return redirect()->intended(route('home'));
            $request->session()->regenerate();
            return response()->json(['message' => __('auth.login.success')], 200);
        }

        return response()->json(['message' => __('auth.login.failed')], 401);
    }
}
