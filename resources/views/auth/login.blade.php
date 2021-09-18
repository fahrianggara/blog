@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
       <label class="small mb-1" for="input_login_email">{{ __('E-Mail Address') }}</label>
       <input name="email" class="form-control py-4 @error('email') is-invalid @enderror" id="email" type="email" placeholder="Enter email address" value="{{ old('email') }}" autocomplete="email" autofocus/>

       @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ trans($message) }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
       <label class="small mb-1" for="input_login_password">{{ __('Password') }}</label>
       <input name="password" class="form-control py-4 @error('password') is-invalid @enderror" id="password" type="password" placeholder="Enter password" autocomplete="current-password"/>

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
        @if (Route::has('password.request'))
            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
        @endif

       <button class="btn btn-primary px-4" type="submit">Login</button>
    </div>

 </form>

 <!-- for message validation -->
 <span class="invalid-feedback" role="alert">
    <strong>message</strong>
 </span>

@endsection
