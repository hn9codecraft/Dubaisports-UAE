@extends('frontend.layouts.layout')
@section('content')
<div class="inner-banner mb-2">
    <img src="{{ env('APP_URL').'front/images/getaquote.png' }}" class="img-fluid" alt="">
</div>
<div class="quote-section spacing-y">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6">

                <div class="mb-md-4 mb-3 border-bottom border-2 pb-2">
                    <h2 class="mb-0 ">Get A <span class="text-primary">Quote</span></h2>
                </div>
                <div class="mb-4">
                    <h5> PRODUCT RECOMMENDATION</h5>
                    <p>We strive to deliver the maximum efficiency at the minimal price. We ensure the products supplied are suitable for your specific requirements. From a simple tub of protein or fat-burner to equipping a full-scale commercial gym, we will guide you all the way. We can design and manufacture equipment to your own specification, even if such items are not currently available.</p>
                </div>
                <div class="mb-4">
                    <h5> SUPPORT</h5>
                    <p>When you trust our Solution and product line, you will be delivered with the highest quality after-sale service. Our Expert Technician will be of your help whenever you need and will strive to enhance and shield the lifespan and value of your investment.</p>
                </div>
                <div class="mb-4">
                    <h5> INTERIOR DESIGN</h5>
                    <p>Our immense expertise in designing gym and fitness space made us innovators in this domain. We know the Psychology of wellbeing, How the environment and ambience factor the physical and mental health. We will Provide expert advice on design, planning and Space distribution and equipment layouts.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form bg-light rounded-3 p-md-5 p-4">
                    {{ Form::open(['url' => route('front.quote.store'), 'class' => 'form-horizontal', 'files' => true]) }}
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name']) }}
                            <span class='text-danger'>{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Email</label>
                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) }}
                            <span class='text-danger'>{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Phone Number</label>
                            {{ Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone']) }}
                            <span class='text-danger'>{{ $errors->first('phone') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Company</label>
                            {{ Form::text('company', old('company'), ['class' => 'form-control', 'placeholder' => 'Company']) }}
                            <span class='text-danger'>{{ $errors->first('company') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Location</label>
                            {{ Form::text('location', old('location'), ['class' => 'form-control', 'placeholder' => 'Location']) }}
                            <span class='text-danger'>{{ $errors->first('location') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Description</label>
                            {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Description']) }}
                            <span class='text-danger'>{{ $errors->first('description') }}</span>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary mt-3 px-4" pb-role="submit">Send Enquiry</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
{{ Html::style('backend/plugins/toster/toster.min.css') }}
@stop
@section('js')
{{ Html::script('backend/plugins/toster/toster.min.js') }}
@stop