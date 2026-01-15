<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login() {
        return view('auth.login');
    }

    public function login_action(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            if (auth()->user()->hasRole('member')) {
                return redirect()->route('member.dashboard');
            }

            Auth::logout();
            return redirect('login')->with('error', 'Role tidak dikenali');
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah'
        ]);
    }

    public function destroy(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
