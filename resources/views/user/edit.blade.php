@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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

            <!-- Address Field -->
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" required>
            </div>

            <!-- Phone Field -->
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>



            <!-- Submit Button -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
@endsection
