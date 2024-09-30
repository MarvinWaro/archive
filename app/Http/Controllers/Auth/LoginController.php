<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view("admin.auth.login");
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed
            // Log the successful attempt
            \Log::info('User logged in: ' . Auth::user()->email);

            // Redirect to the intended route or dashboard
            return redirect()->route('showAll');
        } else {
            // Log failed attempt for debugging
            \Log::warning('Login failed for: ' . $request->email);
            return back()->withErrors(['message' => 'Invalid credentials']);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }

}
