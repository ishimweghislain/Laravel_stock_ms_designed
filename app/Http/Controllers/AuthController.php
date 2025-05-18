<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        if(Auth::attempt($credentials)){
            // Authentication passed
            return redirect()->intended('dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = new User;
        $user->username = $validatedData['username'];
        // Don't use bcrypt here as the User model already hashes the password
        $user->password = $validatedData['password'];
        $user->save();

        // Log the user in
        Auth::login($user);

        // Regenerate the session
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
