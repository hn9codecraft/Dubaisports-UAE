@extends('frontend.layouts.layout')

@section('content')
<div class="login-page spacing-y">
    <div class="d-flex justify-content-center align-items-center position-relative h-100">
      <div class="sign-in-form">
        <form method="POST" action="{{ route('password.email') }}" class="text-center m-auto p-4">
            @csrf
          <img src="{{ env('APP_URL').'front/images/site_logo.png' }}" alt="site_logo" class="my-4 img-fluid">
          <div class="d-flex form-group mb-3">
            <span class="square-icon"><i class="fas fa-user"></i></span>
            <input id="email" type="email" placeholder="Email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          </div>
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @error('email')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          <button type="submit" class="btn btn-info mt-3 px-4">{{ __('Send Password Reset Link') }} </button>
          <a href="{{ route('login') }}" class="btn btn-link d-block text-center mb-2">Login</a>
        </form>
      </div>
    </div>
  </div>
@endsection
