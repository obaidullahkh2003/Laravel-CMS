@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Edit Admin</h1>
        <form action="{{ route('admin.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Password Field (Optional) -->
            <div class="form-group">
                <label>Password (leave blank to keep current password)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <!-- Role Selection -->
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="">Select a Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Update Admin</button>
            </div>
        </form>
    </div>
@endsection
