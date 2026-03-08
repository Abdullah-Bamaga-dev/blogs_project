@extends('admin.layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light text-secondary font-weight-bold shadow-sm"
            style="border-radius: 8px;">
            &larr; Back to Users
        </a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-secondary mb-0">Edit User: {{ $user->name }}</h3>
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
    @if (session('ErrorDeleteAdmin'))
        <div class="alert alert-success">
            {{ session('ErrorDeleteAdmin') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="form-group">
                    <label for="name" class="font-weight-bold">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="role" class="font-weight-bold">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        @if (auth()->id() === 5)
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin
                            </option>
                        @endif
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary font-weight-bold px-4">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
