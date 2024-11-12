@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>Create Service</h1>
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="icon">Icon (Upload Image)</label>
                <input type="file" name="icon" class="form-control" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <input type="checkbox" name="is_active" value="1">
            </div>
            <button type="submit" class="btn btn-primary">Create Service</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Back to Services</a>
        </form>
    </div>
@endsection
