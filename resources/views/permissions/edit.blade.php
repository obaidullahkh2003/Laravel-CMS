@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>Edit Permission</h1>

        <form action="{{ route('permissions.update', $permission) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Permission Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
