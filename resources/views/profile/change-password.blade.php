@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0">
                    <i class="bi bi-key-fill"></i> Change Password
                </h4>
            </div>
            <div class="card-body p-5">
                <form method="POST" action="{{ route('change.password') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock text-primary"></i> Old Password
                        </label>
                        <input type="password" class="form-control form-control-lg" name="old_password" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock-fill text-primary"></i> New Password
                        </label>
                        <input type="password" class="form-control form-control-lg" name="new_password" required>
                        <small class="text-muted">Minimum 6 characters</small>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle"></i> Change Password
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection