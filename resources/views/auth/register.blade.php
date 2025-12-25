@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center mt-5 pt-4">
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="text-center mb-3">
            <i class="bi bi-person-plus-fill text-primary" style="font-size: 3rem;"></i>
            <h2 class="fw-bold text-primary mt-2">Create Account</h2>
            <p class="text-muted mb-0">Join QuizMaster today!</p>
        </div>
        
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <h4 class="text-center mb-3">Sign Up Now</h4>
                <p class="text-center text-muted small mb-3">Fill in the information below</p>
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-badge-fill text-primary"></i> Full Name
                        </label>
                        <input type="text" class="form-control form-control-lg" 
                               name="full_name" 
                               value="{{ old('full_name') }}" 
                               placeholder="Enter your full name"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-fill text-primary"></i> Username
                        </label>
                        <input type="text" class="form-control form-control-lg" 
                               name="username" 
                               value="{{ old('username') }}" 
                               placeholder="Choose a username"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock-fill text-primary"></i> Password
                        </label>
                        <input type="password" class="form-control form-control-lg" 
                               name="password" 
                               placeholder="Create a password (min. 8 chars)"
                               minlength="8"
                               required>
                        <small class="text-muted">Minimum 8 characters required</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-shield-check text-primary"></i> Confirm Password
                        </label>
                        <input type="password" class="form-control form-control-lg" 
                               name="password_confirmation" 
                               placeholder="Re-enter your password"
                               minlength="8"
                               required>
                    </div>
                    
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            <i class="bi bi-person-plus"></i> Create Account
                        </button>
                    </div>
                </form>
                
                <hr class="my-3">
                
                <div class="text-center">
                    <p class="mb-0">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                            Login here <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-3 mb-5">
            <p class="text-muted">
                <small>&copy; 2025 QuizMaster. All rights reserved.</small>
            </p>
        </div>
    </div>
</div>
@endsection