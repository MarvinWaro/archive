<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('admin.profile', compact('user'));
    }
}
