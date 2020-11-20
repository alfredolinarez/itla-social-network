<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        Log::info('attempting auth', $credentials);

        if(Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return view('login', ['login_failed' => true]);
    }

    public function register (Request $request)
    {
        $userInfo = $request->all();

        $user = new User($userInfo);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if(Auth::attempt($request->only('username', 'password')))
        {
            return redirect(route('home'));
        }

        return view('register');
    }
}
