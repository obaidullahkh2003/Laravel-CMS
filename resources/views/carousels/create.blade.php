@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Create Carousel</h1>
        <form action="{{ route('carousels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <div class="form-group">
                <label>Subheading</label>
                <input type="text" name="subheading" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Heading</label>
                <input type="text" name="heading" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Button Text</label>
                <input type="text" name="button_text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Button Link</label>
                <input type="text" name="button_link" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Is Active</label>
                <input type="checkbox" name="is_active" value="1" checked>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('carousels.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
