<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Hard-coded credentials check
        if ($username === 'admin' && $password === 'admin123') {
            // Simple approach without sessions as requested
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['message' => 'Invalid credentials']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}