@extends('base')

@section('title')
    Admin Register
@endsection

@section('content')

    <style>
        .input-custom{
            padding: 14px;
        }

        .button-custom{
            padding: 14px !important;
        }

        .label-custom{
            font-size: 15px;
            color: #0033A0 !important;
        }

        .login-link{
            text-decoration: none;
            color: #0033A0;
            font-size: 15px;
        }

        .custom-card {
            box-shadow: 0 10px 25px rgba(0, 0, 15, 5.15) !important;
        }

    </style>

    <div class="d-flex justify-content-center align-items-center vh-100 ched-img-bg">
        <div class="card p-4 shadow-lg px-4 custom-card" style="width: 100%; max-width: 470px; border-radius: 30px; padding: 25px 40px !important">
            <!-- Logo Section -->
            <div class="logo-wrapper d-flex justify-content-center mb-4 mt-4">
                <img class="ched-logo-login" src="{{ asset('assets/img/ched_logo.png') }}" alt="Ched Logo" style="max-width: 150px;">
                <br>
            </div>

            <h4 class="text-center text-heading mb-4 mt-2">Admin Register</h4>

            <!-- Login Form -->
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label text-black label-custom">Name</label>
                    <input type="text" name="name" class="form-control input-custom" id="name" placeholder="testuser123" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-black label-custom">Email</label>
                    <input type="email" name="email" class="form-control input-custom" id="email" placeholder="testuser@ched.gov.ph" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-black label-custom">Password</label>
                    <input type="password" name="password" class="form-control input-custom" id="password" placeholder="**********" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label text-black label-custom">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control input-custom" id="password_confirmation" placeholder="**********" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary button-custom">Register</button>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <p class="text-center mt-3"><a href="{{ url('admin/login') }}" class="login-link">Login Here</a></p>
                </div>
            </form>

        </div>
    </div>


@endsection

