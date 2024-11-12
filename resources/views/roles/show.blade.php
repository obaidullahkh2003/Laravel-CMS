@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Role Details</h1>

        <div>
            <strong>ID:</strong> {{ $role->id }}
        </div>
        <div>
            <strong>Name:</strong> {{ $role->name }}
        </div>
        <div>
            <strong>Permissions:</strong>
            {{ implode(', ', $role->permissions->pluck('name')->toArray()) }}
        </div>

        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles</a>
        @if(in_array('edit role', array_keys($permissionsArray)))
        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit</a>
        @endif
        @if(in_array('delete role', array_keys($permissionsArray)))
        <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endif
    </div>
@endsection
