@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <h1>Create Block</h1>
    <form action="{{ route('blocks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="region_id">Region</label>
            <select name="region_id" id="region_id" class="form-control" required>
                <option value="">Select a Region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="default" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control">
        </div>
        <div class="form-group">
            <label for="is_active">Is Active</label>
            <input type="checkbox" name="is_active" id="is_active" value="1" checked>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('blocks.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
