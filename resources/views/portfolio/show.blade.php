@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>{{ $portfolioItem->title }}</h1>

        <p><strong>Subtitle:</strong> {{ $portfolioItem->subtitle }}</p>

        <div class="mb-4">
            <img src="{{ asset('storage/' . $portfolioItem->image_path) }}" alt="Image" class="img-fluid">
        </div>

        <p><strong>Status:</strong> {{ $portfolioItem->is_active ? 'Active' : 'Inactive' }}</p>
        <p><strong>Client:</strong> {{ $portfolioItem->client_name }}</p>
        <p><strong>Category:</strong> {{ $portfolioItem->category }}</p>

        <div class="mt-3">
            @if(in_array('edit portfolio', array_keys($permissionsArray)))
            <a href="{{ route('portfolio.edit', $portfolioItem) }}" class="btn btn-warning">Edit</a>
            @endif
            <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
