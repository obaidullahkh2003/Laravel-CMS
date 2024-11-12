@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>Edit Portfolio Item</h1>
        <form action="{{ route('portfolio.update', $portfolioItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $portfolioItem->title }}" required>
            </div>
            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $portfolioItem->subtitle }}">
            </div>
            <div class="form-group">
                <label for="client_name">Client</label>
                <input type="text" class="form-control" name="client_name" id="client_name" value="{{ $portfolioItem->client_name }}">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" name="category" id="category" value="{{ $portfolioItem->category }}">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image_path" id="image">
                <img src="{{ asset('storage/' . $portfolioItem->image_path) }}" alt="Current Image" class="img-fluid" width="100">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="is_active" {{ $portfolioItem->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
