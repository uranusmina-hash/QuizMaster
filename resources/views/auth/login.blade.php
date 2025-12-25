@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center mt-5 pt-4">
    <div class="col-11 col-sm-10 col-md-8 col-lg-5 col-xl-4">
        <div class="text-center mb-3">
            <i class="bi bi-mortarboard-fill text-primary" style="font-size: 3rem;"></i>
            <h2 class="fw-bold text-primary mt-2">QuizMaster</h2>
            <p class="text-muted mb-0">Smart Online Quiz System</p>
        </div>
        
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <h4 class="text-center mb-3">Welcome Back!</h4>
                <p class="text-center text-muted small mb-3">Login to continue</p>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-fill text-primary"></i> Username
                        </label>
                        <input type="text" class="form-control form-control-lg" 
                               name="username" 
                               value="{{ old('username') }}" 
                               placeholder="Enter your username"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock-fill text-primary"></i> Password
                        </label>
                        <input type="password" class="form-control form-control-lg" 
                               name="password" 
                               placeholder="Enter your password"
                               minlength="8"
                               required>
                        <small class="text-muted">Minimum 8 characters required</small>
                    </div>
                    
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </form>
                
                <hr class="my-3">
                
                <div class="text-center">
                    <p class="mb-0">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                            Register here <i class="bi bi-arrow-right"></i>
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