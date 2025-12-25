@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <i class="bi bi-house-door-fill fs-1"></i>
                <h3 class="mt-2 mb-0">Welcome, {{ $user->full_name }}!</h3>
                <span class="badge bg-light text-primary mt-2 fs-6">
                    <i class="bi bi-award-fill"></i> {{ ucfirst($user->role) }}
                </span>
            </div>
            <div class="card-body p-5">
                <div class="row g-4">
                    @if($user->role == 'admin')
                        <div class="col-md-6">
                            <div class="card bg-primary text-white h-100 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-gear-fill display-1"></i>
                                    <h5 class="mt-3">Admin Panel</h5>
                                    <p class="mb-3">Manage questions and view scores</p>
                                    <a href="{{ route('admin.panel') }}" class="btn btn-light btn-lg w-100">
                                        <i class="bi bi-arrow-right-circle"></i> Go to Panel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-secondary text-white h-100 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-key-fill display-1"></i>
                                    <h5 class="mt-3">Change Password</h5>
                                    <p class="mb-3">Update your account password</p>
                                    <a href="{{ route('change.password.form') }}" class="btn btn-light btn-lg w-100">
                                        <i class="bi bi-arrow-right-circle"></i> Change Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4">
                            <div class="card bg-success text-white h-100 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-pencil-square display-1"></i>
                                    <h5 class="mt-3">Take Quiz</h5>
                                    <p class="mb-3">Start a new quiz</p>
                                    <a href="{{ route('quiz.show') }}" class="btn btn-light btn-lg w-100">
                                        <i class="bi bi-play-circle"></i> Start
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-dark h-100 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-trophy-fill display-1"></i>
                                    <h5 class="mt-3">My Results</h5>
                                    <p class="mb-3">View quiz history</p>
                                    <a href="{{ route('quiz.results') }}" class="btn btn-dark btn-lg w-100">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white h-100 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-key-fill display-1"></i>
                                    <h5 class="mt-3">Password</h5>
                                    <p class="mb-3">Update password</p>
                                    <a href="{{ route('change.password.form') }}" class="btn btn-light btn-lg w-100">
                                        <i class="bi bi-shield-lock"></i> Change
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection