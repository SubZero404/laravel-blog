@extends('layouts.app')

@section('content')
<div class=" container-fluid pt-5 d-flex justify-content-center align-items-center" >
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0" style="background-color: #111; color: #fff; border-radius: 0.5rem;">
            <div class="card-header text-center fw-bold" style="background-color: #111; color: #fff; font-size: 1.5rem; border-bottom: 1px solid #333;">
                {{ __('Login') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                        <input id="email" type="email" 
                               class="form-control bg-black text-white border-secondary @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                        <input id="password" type="password" 
                               class="form-control bg-black text-white border-secondary @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn fw-bold" style="background-color: #fff; color: #000;">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="text-white text-decoration-underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #000;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #fff;
    }
    .btn:hover {
        background-color: #e0e0e0;
        color: #000;
    }
</style>
@endsection
