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
use App\Models\LoginHistory; // Add this line
use Jenssegers\Agent\Agent;



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
        // Validate the request with custom error messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed', // Min length 8 characters
        ], [
            'password.min' => 'The password must be at least 8 characters long.', // Custom message for password length
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

        // Check if the email exists in the database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Email does not exist, return a specific error message
            Log::warning('Login attempt with non-existent email: ' . $request->email);
            return back()->withErrors(['message' => 'Account does not exist in the database']);
        }

        // Attempt to authenticate the user with email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed
            Log::info('User logged in: ' . Auth::user()->email);

            // Get the IP address
            $ipAddress = $request->ip();

            // Get browser and OS information using Jenssegers Agent
            $agent = new Agent();
            $browser = $agent->browser();
            $browserVersion = $agent->version($browser);
            $os = $agent->platform();
            $osVersion = $agent->version($os);

            // Record login history
            LoginHistory::create([
                'user_id' => Auth::id(), // Save the currently authenticated user's ID
                'logged_in_at' => now(), // Store the current timestamp
                'ip_address' => $ipAddress, // Store the user's IP address
                'browser' => $browser . ' (v' . $browserVersion . ')', // Store browser info
                'os' => $os . ' ' . $osVersion, // Store OS info
            ]);

            // Flash a welcome message to the session
            session()->flash('welcome_message', 'Welcome ' . Auth::user()->name . '!');

            // Redirect to the dashboard
            return redirect()->route('dashboard');
        } else {
            // Authentication failed, wrong password
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


    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Log the user out first
        Auth::logout();

        // Delete the user's account
        $user->delete();

        // Flash a session message for feedback
        session()->flash('account_deleted', 'Your account has been successfully deleted.');

        // Redirect to the login page
        return redirect()->route('login');
    }




}
