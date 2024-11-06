@extends('admins.admin')

@section('main-content')
    <div class="container mt-4">
        <h1>Edit Navigation Item</h1>

        <form action="{{ route('navigations.update', $navigation) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="label">Label</label>
                <input type="text" name="label" class="form-control" value="{{ old('label', $navigation->label) }}" required>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" class="form-control" value="{{ old('url', $navigation->url) }}" required>
            </div>

            <div class="form-group">
                <label for="order">Order</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $navigation->order) }}" required>
            </div>

            <div class="form-group">
                <label for="is_active">IS Active</label>
                <input type="checkbox" name="is_active" value="1" {{ $navigation->is_active ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('navigations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
