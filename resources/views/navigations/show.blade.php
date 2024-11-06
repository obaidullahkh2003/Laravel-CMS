@extends('admins.admin')

@section('main-content')
    <div class="container mt-4">
        <h1>Navigation Item Details</h1>

        <div class="mb-3">
            <strong>Label:</strong> {{ $navigation->label }}
        </div>
        <div class="mb-3">
            <strong>URL:</strong> {{ $navigation->url }}
        </div>
        <div class="mb-3">
            <strong>Order:</strong> {{ $navigation->order }}
        </div>
        <div class="mb-3">
            <strong>Active:</strong> {{ $navigation->is_active ? 'Yes' : 'No' }}
        </div>

        <a href="{{ route('navigations.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
