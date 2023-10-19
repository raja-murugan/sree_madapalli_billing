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
                        <h3>Create an Account</h3>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-login">
                            <label>Full Name</label>
                            <div class="form-addons">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Enter your full name">
                                <img src="{{ asset('assets/backend/img/icons/users1.svg') }}" alt="img">
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Enter your email address">
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
                                <input id="password" type="password"
                                class="pass-input form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password" placeholder="Enter your password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-login">
                            <label>Confirm Password</label>
                            <div class="pass-group">
                                <input id="password-confirm" type="password" class="pass-input form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter your password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <button class="btn btn-login"
                                        type="submit">Sign Up</button>
                        </div>
                    </form>
                    <div class="signinform text-center">
                        <h4>Already a user? <a href="{{ route('login') }}" class="hover-a">Sign In</a></h4>
                    </div>
                </div>
            </div>
            <div class="login-img">
                <img src="{{ asset('assets/backend/img/login.jpg') }}" alt="img">
            </div>
        </div>
    </div>
@endsection
