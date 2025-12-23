<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only('name', 'email', 'password', 'password_confirmation');

        // $validator = Validator::make($data, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()->first()], 422);
        // }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response()->json(['message' => __('auth.register.success')], 200);
    }
}
