@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <h1>Edit Block Region</h1>
    <form action="{{ route('blockRegions.update', $blockRegion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $blockRegion->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('blockRegions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
