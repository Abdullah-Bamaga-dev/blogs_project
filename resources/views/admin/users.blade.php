@extends('admin.layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light text-secondary font-weight-bold shadow-sm"
            style="border-radius: 8px;">
            &larr; Back to Dashboard
        </a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold text-secondary mb-0">Manage Users</h3>
        <a href="#" class="btn btn-primary font-weight-bold">
            + Add New User
        </a>
    </div>
    @if (session('UserDeleteStatus'))
        <div class="alert alert-success">
            {{ session('UserDeleteStatus') }}
        </div>
    @endif
    @if (session('ErrorDeleteAdmin'))
        <div class="alert alert-danger">
            {{ session('ErrorDeleteAdmin') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                @if ($user->role === 'admin')
                                    <span class="badge badge-success px-2 py-1">Admin</span>
                                @else
                                    <span class="badge badge-secondary px-2 py-1">User</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="#" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.destroy', ['user' => $user]) }}" method="POST"
                                    class="d-inline" id="delete_form_{{ $user->id }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
