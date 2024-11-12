@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>{{ $carousel->heading }}</h1>
        <p><strong>Subheading:</strong> {{ $carousel->subheading }}</p>
        <p><strong>Image URL:</strong> <a href="{{ $carousel->image_url }}">{{ $carousel->image_url }}</a></p>
        <p><strong>Button Text:</strong> {{ $carousel->button_text }}</p>
        <p><strong>Button Link:</strong> <a href="{{ $carousel->button_link }}">{{ $carousel->button_link }}</a></p>
        <p><strong>Active:</strong> {{ $carousel->is_active ? 'Yes' : 'No' }}</p>
        <a href="{{ route('carousels.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
