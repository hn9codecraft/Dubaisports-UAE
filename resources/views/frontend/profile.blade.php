@extends('frontend.layouts.layout')
@section('content')
<div class="spacing-y">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-5 text-center">My <span class="text-primary">Profile</span></h2>
        </div>
        
        <div class="row">
            @include('frontend.layouts.customer_sidebar')
            
            <div class="col-md-9">
                <div class="card border border-secondary shadow-sm rounded p-4">
                    <h4 class="mb-4 pb-2 border-bottom fw-bold">Personal Information</h4>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('front.customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-3 text-center">
                                @if($user->avatar)
                                    <img src="{{ asset($user->avatar) }}" id="avatar-preview" alt="Profile Image" class="img-fluid rounded-circle border border-secondary shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <img src="" id="avatar-preview" alt="Profile Image" class="img-fluid rounded-circle border border-secondary shadow-sm d-none" style="width: 120px; height: 120px; object-fit: cover;">
                                    <div id="avatar-placeholder" class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto text-white" style="width: 120px; height: 120px; font-size: 3rem;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9 mt-3 mt-md-0">
                                <label for="avatar" class="form-label fw-semibold">Profile Image</label>
                                <input type="file" class="form-control bg-light" id="avatar" name="avatar" accept="image/*">
                                <small class="text-muted">Upload a new profile image (JPG, PNG). Max size: 2MB.</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-light" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label for="last_name" class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-light" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control bg-light text-muted" id="email" value="{{ $user->email }}" readonly disabled>
                                <small class="text-muted">Email address cannot be changed.</small>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control bg-light" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                        </div>
                        
                        <h4 class="mt-5 mb-4 pb-2 border-bottom fw-bold">Change Password</h4>
                        <p class="text-muted small mb-3">Leave blank if you do not want to change your password.</p>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">New Password</label>
                                <input type="password" class="form-control bg-light" id="password" name="password">
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                                <input type="password" class="form-control bg-light" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary px-5 fw-bold py-2">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('avatar-preview');
                const placeholder = document.getElementById('avatar-placeholder');
                
                if (previewImg) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                }
                
                if (placeholder) {
                    placeholder.classList.remove('d-flex');
                    placeholder.classList.add('d-none');
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@stop
