@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Access Denied
                    </h4>
                </div>
                <div class="card-body text-center py-5">
                    <i class="fas fa-shield-alt fa-5x text-danger mb-4"></i>
                    <h2 class="text-danger mb-3">Access Denied</h2>
                    <p class="text-muted mb-4">
                        You don't have permission to access this page. This area is restricted to authorized personnel only.
                    </p>
                    
                    @auth
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            You are logged in as: <strong>{{ auth()->user()->name }}</strong> 
                            ({{ ucfirst(auth()->user()->role) }})
                        </div>
                        
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary me-2">
                                <i class="fas fa-tachometer-alt me-2"></i>Go to Admin Dashboard
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">
                                <i class="fas fa-home me-2"></i>Go to Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary me-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    @endauth
                    
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        background-color: #000 !important;
        color: #ffc0cb !important;
    }
    
    .card {
        box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #ffc0cb 0%, #ff69b4 100%);
        border-color: #ffc0cb;
        color: #000 !important;
        font-weight: 600;
    }
    
    .btn-primary:hover {
        background: #000;
        color: #ffc0cb !important;
        border-color: #ffc0cb;
    }
    
    .btn-outline-secondary {
        border-color: #ffc0cb;
        color: #ffc0cb;
    }
    
    .btn-outline-secondary:hover {
        background: #ffc0cb;
        color: #000;
    }
</style>
