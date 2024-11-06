@extends('admins.admin')

@section('main-content')
    <h1>Edit Block</h1>
    <form action="{{ route('blocks.update', $block) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="region_id">Region ID</label>
            <input type="text" name="region_id" id="region_id" class="form-control" value="{{ $block->region_id }}" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $block->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" >{{ $block->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control">
            <small>Leave blank to keep the current image.</small>
        </div>
        <div class="form-group">
            <label for="is_active">Is Active</label>
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $block->is_active ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('blocks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
