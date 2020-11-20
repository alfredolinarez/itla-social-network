<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index(Request $request){
        $intended = session('url.intended');
        $request->session()->forget('url.intended');

        if($intended == url('/')) {
            $intended = '';
        }

        return view('login', [
            'not_authenticated' => $intended,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }

        return view('login', ['login_failed' => true]);
    }

    public function register (Request $request)
    {
        $userInfo = $request->all();

        $user = new User($userInfo);

        $exists = User::where(['username' => $user->username])->first();
        if($exists) {
            return view('register', ['user_exists' => true]);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        if(Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('home');
        }

        return view('register');
    }
}
