<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User; // Import User Model
use Illuminate\Support\Facades\Log; // Import logging if not already imported

class AuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('admin.auth.register'); // Ensure this view exists
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Redirect or return a success message
        return redirect('admin/login')->with('success', 'Registration successful! Please log in.');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('admin.auth.login'); // Ensure this view exists
    }

    // Handle login
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
            Log::info('User logged in: ' . Auth::user()->email);

            // Redirect to the intended route or dashboard
            return redirect()->route('dashboard');
        } else {
            // Log failed attempt for debugging
            Log::warning('Login failed for: ' . $request->email);
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    // Handle logout
    public function logout(Request $request)
    {
        Log::info('User is logging out.');
        Auth::logout();
        return redirect('admin/login');
    }


    // Show forget password form
    public function showForgetPasswordForm()
    {
        return view('admin.auth.forgot'); // Ensure this view exists
    }

    // Handle sending the reset password link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', 'Reset password link was sent to your email!')
            : back()->withErrors(['email' => trans($response)]);
    }

    // Show reset password form
    public function showResetPasswordForm($token)
    {
        return view('admin.auth.reset', ['token' => $token]); // Ensure this view exists
    }

    // Handle reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // Set a success message in the session
            return redirect()->route('login')->with('status', 'Your password has been reset successfully!');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }


    // update internal admin

    public function updateProfile(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        // Update the authenticated user's profile
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // Redirect back with success message
        return back()->with('success', 'Profile updated successfully!');
    }


    // In AuthController.php

    public function updatePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Ensures password confirmation
        ]);

        $user = auth()->user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match.');
        }

        // Update with the new password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }




}
