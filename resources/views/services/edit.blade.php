@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Edit Service</h1>
        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $service->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="icon">Icon (Upload Image)</label>
                <input type="file" name="icon" class="form-control" accept="image/*">
                <small>Current Icon: <img src="{{ asset('storage/'.$service->icon) }}" alt="Current Icon"></small>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
            </div>
            <button type="submit" class="btn btn-primary">Update Service</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Back to Services</a>
        </form>
    </div>
@endsection
