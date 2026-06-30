@extends('frontend.layouts.layout')
@section('content')
<div class="login-page spacing-y">
    <div class="d-flex justify-content-center align-items-center position-relative h-100">
      <div class="sign-in-form">
        <form method="POST" action="{{ route('password.update') }}" class="text-center m-auto p-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
          <img src="{{ env('APP_URL').'front/images/site_logo.png' }}" alt="site_logo" class="my-4 img-fluid">
          <div class="form-group mb-3">
            <div class="d-flex">
                <span class="square-icon"><i class="fas fa-user"></i></span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            </div>
            @error('email')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        <div class="form-group mb-3">
        <div class="d-flex">
           <span class="square-icon"> <i class="fas fa-lock"></i></span>
            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
            @error('password')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex form-group mb-3">
            <span class="square-icon"> <i class="fas fa-lock"></i></span>
            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
          <button type="submit" class="btn btn-info mt-3 px-4">{{ __('Reset Password') }} </button>
        </form>
      </div>
    </div>
  </div>
@endsection

