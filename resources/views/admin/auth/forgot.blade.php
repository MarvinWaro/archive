@extends('base')

@section('title')
    Admin Forgot Password
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

            <h4 class="text-center text-heading mb-4 mt-2">Forgot Password</h4>

            <!-- Login Form -->
            <form action="#">
                <div class="mb-3">
                    <label for="email" class="form-label text-black label-custom">Email</label>
                    <input type="email" class="form-control input-custom" id="email" placeholder="testuser@ched.gov.ph" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary button-custom">Submit</button>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <p class="text-center mt-3"><a href="{{ url('admin/login') }}" class="login-link">Login Here</a></p>
                </div>
            </form>
        </div>
    </div>


@endsection

