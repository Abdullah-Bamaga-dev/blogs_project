@extends('admin.layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light text-secondary font-weight-bold shadow-sm"
            style="border-radius: 8px;">
            &larr; Back to Users
        </a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-secondary mb-0">Add New User</h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required minlength="8">
                    <small class="text-muted">Password must be at least 8 characters long.</small>
                </div>

                <div class="form-group">
                    <label for="role" class="font-weight-bold">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                        @if (auth()->id() === 5)
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        @endif
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary font-weight-bold px-4">
                        Create User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
