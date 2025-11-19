@extends('layouts.auth')

@section('title', 'Sign into your account')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="app-brand justify-content-center mb-4">
                <a href="/" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
                    </span>
                    <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name', 'Laravel') }}</span>
                </a>
            </div>
            <h4 class="mb-2 text-center">Welcome! 👋</h4>
            <p class="mb-4 text-center">Please sign-in to your account</p>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}" id="formAuthentication">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                        autofocus autocomplete="username">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>Forgot Password?</small>
                            </a>
                        @endif
                    </div>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required
                            autocomplete="current-password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember"
                            {{ old('remember') ? 'checked' : '' }} />
                        <label class="form-check-label" for="remember_me"> Remember Me </label>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
                </div>
            </form>
            <p class="text-center">
                <span>New on our platform?</span>
                <a href="{{ route('register') }}">
                    <span>Create an account</span>
                </a>
            </p>
        </div>
    </div>
@endsection
