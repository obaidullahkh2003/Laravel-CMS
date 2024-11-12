@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>Add Portfolio Item</h1>
        <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ old('subtitle') }}">
                @error('subtitle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image_path" id="image" required>
                @error('image_path')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="client">Client</label>
                <input type="text" class="form-control" name="client_name" id="client" value="{{ old('client_name') }}" required>
                @error('client')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" name="category" id="category" value="{{ old('category') }}" required>
                @error('category')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="is_active">
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
