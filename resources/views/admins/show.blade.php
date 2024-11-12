@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Admin Details</h1>

        <!-- User Basic Info -->
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <!-- Display Role -->
        <p><strong>Role:</strong>
            @if($user->roles->isEmpty())
                <strong>No Roles</strong>
            @else
                <strong>{{ $user->roles->first()->name }}</strong>
            @endif
        </p>

        <!-- Buttons -->
        <div class="mt-4">
            @if(in_array('edit admin', array_keys($permissionsArray)))
            <a href="{{ route('admin.edit', $user) }}" class="btn btn-warning">Edit</a>
            @endif
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Back to Admins</a>
        </div>
    </div>
@endsection
