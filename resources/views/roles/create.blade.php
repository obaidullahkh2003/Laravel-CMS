@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Create Role</h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Permissions</label><br>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}" class="form-check-input">
                        <label for="permission_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
                @error('permissions')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
