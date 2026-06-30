@extends('frontend.layouts.layout')

@section('content')
<div class="signup-page step-app"  id="demo">
        <div class="signup position-relative">
            <form class="step-content demo-form" action="{{ route('register') }}" method="post" role="form">
                @csrf
                <div class="sign-up-form setup-content form-section accessdaata wow fadeIn current" id="step-1" data-wow-delay="0.3s">
                    <div class="text-center m-auto p-4">
                        <img src="{{ asset('front/images/site_logo.png') }}" alt="site_logo" class="mb-5 img-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex form-group mb-3 position-relative pb-3">
                                    <span class="square-icon"><i class="fas fa-user"></i></span>
                                    {{ Form::text('first_name', old('first_name'), ['placeholder' => 'First Name', 'class' => 'form-control', 'required']) }}
                                </div>
                                @error('first_name')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex form-group mb-3 position-relative pb-3">
                                    <span class="square-icon"><i class="fas fa-user"></i></span>
                                    {{ Form::text('last_name', old('last_name'), ['placeholder' => 'Last Name', 'class' => 'form-control', 'required']) }}
                                </div>
                                @error('last_name')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="d-flex form-group mb-3 position-relative pb-3">
                                    <span class="square-icon"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Username" required />
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="d-flex form-group mb-3 position-relative pb-3">
                                    <span class="square-icon"><i class="fas fa-envelope"></i></span>
                                    {{ Form::email('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control', 'required']) }}
                                </div>
                                @error('email')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex form-group mb-3 position-relative pb-3">
                                    <span class="square-icon"><i class="fas fa-phone-alt"></i></span>
                                    {{ Form::number('phone', old('phone'), ['placeholder' => 'Phone', 'class' => 'form-control', 'required']) }}
                                </div>
                                @error('phone')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex form-group mb-3 position-relative pb-3">
                                    <span class="square-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                                </div>
                                @error('password')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex form-group mb-3 position-relative pb-3">
                                    <span class="square-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required />
                                </div>
                            </div>
                            <div class="col-12 my-4 form-navigation">
                                <button class="btn btn-info btn-next  px-3 px-4 step-btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                        <div class="content text-center">
                            <h4 class="text-white">One of us ?</h4>
                            <p class="text-white">
                                Login in with your account
                            </p>
                            <a href="{{ route('login') }}" class="btn btn-primary px-4"id="signInbtn">
                                Sign In
                            </a>
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection
