@extends('frontend.layouts.layout')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="login-page spacing-y">
    <div class="d-flex justify-content-center align-items-center position-relative h-100">
      <div class="sign-in-form">
        <form method="POST" action="{{ route('login') }}" class="text-center m-auto p-4">
            @csrf
          <img src="{{ env('APP_URL').'front/images/site_logo.png' }}" alt="site_logo" class="my-4 img-fluid">
          <div class="d-flex form-group mb-3">
            <span class="square-icon"><i class="fas fa-user"></i></span>
            <input id="email" type="email" placeholder="Username" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          </div>
        @error('email')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          <div class="d-flex form-group mb-3">
           <span class="square-icon"> <i class="fas fa-lock"></i></span>
            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-info mt-3 px-4">Login </button>
          <a href="{{ route('password.request') }}" class="btn btn-link d-block text-center mb-2">Forget Password</a>
        </form>
        <div class="content text-center">
          <h4 class="text-white">New Here ?</h4>
          <p class="text-white">
            Create new accout with us!!
          </p>
          <a href="{{ route('register') }}" class="btn btn-primary px-4 " id="signUpbtn">
            Register
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
