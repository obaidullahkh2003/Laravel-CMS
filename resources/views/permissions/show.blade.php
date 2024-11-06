@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Permission Details</h1>

        <div>
            <strong>ID:</strong> {{ $permission->id }}
        </div>
        <div>
            <strong>Name:</strong> {{ $permission->name }}
        </div>

        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back to Permissions</a>
        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
