@extends('admins.admin')

@section('main-content')

    <div class="container">
        <h1>Edit Carousel</h1>
        <form action="{{ route('carousels.update', $carousel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Subheading</label>
                <input type="text" name="subheading" class="form-control" value="{{ $carousel->subheading }}" required>
            </div>
            <div class="form-group">
                <label>Heading</label>
                <input type="text" name="heading" class="form-control" value="{{ $carousel->heading }}" required>
            </div>
            <div class="form-group">
                <label>Button Text</label>
                <input type="text" name="button_text" class="form-control" value="{{ $carousel->button_text }}" required>
            </div>
            <div class="form-group">
                <label>Button Link</label>
                <input type="text" name="button_link" class="form-control" value="{{ $carousel->button_link }}" required>
            </div>
            <div class="form-group">
                <label>Is Active</label>
                <input type="checkbox" name="is_active" value="1" {{ $carousel->is_active ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label>Upload New Image (optional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="form-group">
                <label>Current Image</label>
                <div>
                    <img src="{{ asset('storage/' . $carousel->image_url) }}" alt="Current Image" style="max-width: 100%; height: auto;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('carousels.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
