@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>User Details</h1>

        <!-- User Basic Info -->
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Address:</strong> {{ $user->address }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>

        <!-- User Image -->
        <div>
            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="img-fluid">
        </div>


        <!-- Buttons -->
        <div class="mt-4">
            <a href="{{ route('user.edit', $user) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Back to Users</a>
        </div>
    </div>
@endsection
