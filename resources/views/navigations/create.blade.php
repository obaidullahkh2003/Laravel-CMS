@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container mt-4">
        <h1>Create Navigation Item</h1>

        <form action="{{ route('navigations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="label">Label</label>
                <input type="text" name="label" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="order">Order</label>
                <input type="number" name="order" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="is_active">IS Active</label>
                <input type="checkbox" name="is_active" value="1">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('navigations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
