@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>{{ $service->title }}</h1>
        <p>{{ $service->description }}</p>
        <p><strong>Icon:</strong> <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }} Icon" style="width: 50px; height: auto;"></p>
        <p><strong>Active:</strong> {{ $service->is_active ? 'Yes' : 'No' }}</p>
        <a href="{{ route('services.index') }}" class="btn btn-primary">Back to Services</a>
    </div>
@endsection
