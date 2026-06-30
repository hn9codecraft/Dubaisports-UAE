@extends('frontend.layouts.layout')
@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="join_form bg-white p-lg-5 p-md-4 p-3 rounded-3">
                    <h1 class="text-primary">Join Community</h1>
                    <h2 class="text-secondary">Hi, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                    {{ Form::open(['url' => route('front.users.store'), 'class' => 'mt-md-5 mt-3']) }}
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            {{ Form::text('street_address', old('street_address'), ['class' => 'form-control px-1', 'placeholder' => 'Address', 'required' ]) }}
                            <span class='text-danger'>{{ $errors->first('street_address') }}</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-lg-5 mb-md-4 mb-3">
                                    {{ Form::text('city', old('city'), ['class' => 'form-control px-1', 'placeholder' => 'City', 'required' ]) }}
                                    <span class='text-danger'>{{ $errors->first('city') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-lg-5 mb-md-4 mb-3">
                                    {{ Form::text('state', old('state'), ['class' => 'form-control px-1', 'placeholder' => 'State', 'required' ]) }}
                                    <span class='text-danger'>{{ $errors->first('state') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-lg-5 mb-md-4 mb-3">
                                    {{ Form::text('zipcode', old('zipcode'), ['class' => 'form-control px-1', 'placeholder' => 'Zipcode', 'required' ]) }}
                                    <span class='text-danger'>{{ $errors->first('zipcode') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-lg-5 mb-md-4 mb-3">
                                    {{ Form::text('contact_number', old('contact_number'), ['class' => 'form-control px-1', 'placeholder' => 'Contact Number', 'required' ]) }}
                                    <span class='text-danger'>{{ $errors->first('contact_number') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            @php
                                $designations = Helper::getDesignations();
                            @endphp
                            {{ Form::select('designation_id', ['' => 'Select Job Title'] + $designations, old('designation_id'), ['class' => 'form-select border-0 border-bottom rounded-0 ps-1', 'required']) }}
                            <span class='text-danger'>{{ $errors->first('designation_id') }}</span>
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            @php
                                $skills = Helper::getSkills();
                            @endphp
                            {{ Form::select('skills', ['' => 'Select Skills'] + $skills, old('skills'), ['class' => 'form-select border-0 border-bottom rounded-0 ps-1', 'required']) }}
                            <span class='text-danger'>{{ $errors->first('skills') }}</span>
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            <h3 class="mb-3">English Preference</h3>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="english_fluency" value="Beginner" id="Beginner" checked>
                                    <label class="form-check-label" for="Beginner">
                                        Beginner
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="english_fluency" value="Intermediate" id="Intermediate">
                                    <label class="form-check-label" for="Intermediate">
                                        Intermediate
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="english_fluency" value="Fluent" id="Fluent">
                                    <label class="form-check-label" for="Fluent">
                                        Fluent
                                    </label>
                                </div>
                            </div>
                            <span class='text-danger'>{{ $errors->first('english_fluency') }}</span>
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            <h3 class="mb-3">Work Experience</h3>
                            <livewire:front.work-experience />
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            <select name="availability" class="form-select border-0 border-bottom rounded-0 ps-1" aria-label="Default select example">
                                <option selected>Availability each day</option>
                                <option value="1 to 3 Hours">1 to 3 Hours</option>
                                <option value="3 to 6 Hours">3 to 6 Hours</option>
                                <option value="More Than 6 Hours">More Than 6 Hours</option>
                            </select>
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            <h3 class="mb-3">About</h3>
                            <div class="form-floating">
                                {{ Form::textarea('about_self', old('about_self'), ['class' => 'form-control border rounded-2', 'rows' => 5, 'placeholder' => "Tell us about yourself"]) }}
                                <label for="floatingTextarea">Tell us about yourself</label>
                            </div>
                            <span class='text-danger'>{{ $errors->first('about_self') }}</span>
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            {{ Form::text('linkedin_link', old('linkedin_link'), ['class' => 'form-control px-1', 'placeholder' => "Linkedin"]) }}
                            <span class='text-danger'>{{ $errors->first('linkedin_link') }}</span>
                        </div>
                        <div class="mb-lg-5 mb-md-4 mb-3">
                            {{ Form::text('github_link', old('github_link'), ['class' => 'form-control px-1', 'placeholder' => "Github"]) }}
                            <span class='text-danger'>{{ $errors->first('github_link') }}</span>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary text-white">Submit</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@stop