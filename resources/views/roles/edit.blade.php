@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Edit Role</h1>

        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Role Name Field -->
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Permissions Section -->
            <div class="form-group">
                <label>Permissions</label><br>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}"
                               value="{{ $permission->id }}"
                               class="form-check-input"
                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                        <label for="permission_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
                @error('permissions')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
