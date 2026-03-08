@extends('admin.layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="font-weight-bold text-secondary">Admin Dashboard</h3>
            <p class="text-muted">Welcome back , <strong>{{ Auth::user()->name }}</strong> , manage your system from here.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-secondary mb-1">Users</h5>
                            <h2 class="font-weight-bold text-dark mb-0">{{ $usersCount }}</h2>
                        </div>
                        <div>
                            <span style="font-size: 2rem;">👥</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection