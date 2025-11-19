@extends('layouts.auth')

@section('title', 'Make your account')

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
            <h4 class="mb-2 text-center">Adventure starts here 🚀</h4>
            <p class="mb-4 text-center">Make your app management easy and fun!</p>
            <form method="POST" action="{{ route('register') }}" id="formAuthentication">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                        autofocus autocomplete="name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                        autocomplete="username">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required
                            autocomplete="new-password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror" required
                            autocomplete="new-password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                        <label class="form-check-label" for="terms-conditions">
                            I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
            </form>
            <p class="text-center mt-3">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}">
                    <span>Sign in instead</span>
                </a>
            </p>
        </div>
    </div>
@endsection
