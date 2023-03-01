<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'email' => ['email', 'required'],
            'password' => ['required']
        ];

        $user = $request->validate($rules);

        if (Auth::attempt($user)) {
            $request->session()->regenerate();
 
            return redirect()->intended('home');
        } else {
            return redirect('/');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }




}


