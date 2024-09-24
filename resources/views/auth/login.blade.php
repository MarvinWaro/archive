@extends('base')

@section('title')
    Admin Login
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100 ched-img-bg">
        <div class="card p-4 shadow-lg px-4" style="width: 100%; max-width: 400px;">
            <!-- Logo Section -->
            <div class="logo-wrapper d-flex justify-content-center mb-4 mt-4">
                <img class="ched-logo-login" src="{{ asset('assets/img/ched_logo.png') }}" alt="Ched Logo" style="max-width: 150px;">
                <br>
            </div>

            <h4 class="text-center text-heading mb-4 mt-2">ADMIN LOGIN</h4>

            <!-- Login Form -->
            <form action="#">
                <div class="mb-3">
                    <label for="email" class="form-label text-black label-edit">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-black label-edit">Password</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <p class="text-center mt-3">Don't have an account? <a href="#">Register here</a></p>
            </form>
        </div>
    </div>
@endsection

