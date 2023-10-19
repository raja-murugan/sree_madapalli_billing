@extends('layout.backend.guest')

@section('content')
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset">
                    <div class="login-logo logo-normal">
                        <img src="{{ asset('assets/backend/img/logo.png') }}" alt="img">
                    </div>
                    <a href="javascript::void(o);" class="login-logo logo-white">
                        <img src="{{ asset('assets/backend/img/logo-white.png') }}" alt>
                    </a>
                    <div class="login-userheading">
                        <h3>Sign In</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="form-login">
                        <label>Email</label>
                        <div class="form-addons">
                            <input type="email" id="email"
                            class="floating form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            autofocus placeholder="Enter your email address">
                            <img src="{{ asset('assets/backend/img/icons/mail.svg') }}" alt="img">
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-login">
                        <label>Password</label>
                        <div class="pass-group">
                            <input type="password" id="password"
                            class="pass-input floating form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Enter your password">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-login">
                        <div class="alreadyuser">
                            <h4><a href="javascript::void(o);" class="hover-a">Forgot Password?</a></h4>
                        </div>
                    </div>
                    <div class="form-login">
                        <button class="btn btn-login"
                                        type="submit">Sign In</button>
                    </div>
                    </form>
                    <div class="signinform text-center">
                        <h4>Don’t have an account? <a href="{{ route('register') }}" class="hover-a">Sign Up</a></h4>
                    </div>
                </div>
            </div>
            <div class="login-img">
                <img src="{{ asset('assets/backend/img/login.jpg') }}" alt="img">
            </div>
        </div>
    </div>
@endsection
