<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('auth');
    }

    public function register(Request $request) {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('auth.page')->with('success', 'Register successfully! Please login.');
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if($user->role === 'admin'){
                return redirect('/admin/books');
            }

            return redirect('/user/books');
            
        }

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.page');
    }
}