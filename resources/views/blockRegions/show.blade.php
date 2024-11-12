@extends('admins.admin')

@section('main-content')
    <h1>Block Region Details</h1>
    <p><strong>ID:</strong> {{ $blockRegion->id }}</p>
    <p><strong>Name:</strong> {{ $blockRegion->name }}</p>

    <a href="{{ route('blockRegions.index') }}" class="btn btn-secondary">Back to List</a>
    @if(in_array('edit region', array_keys($permissionsArray)))
        <a href="{{ route('blockRegions.edit', $blockRegion) }}" class="btn btn-warning">Edit</a>
    @endif
    @if(in_array('delete region', array_keys($permissionsArray)))
        <form action="{{ route('blockRegions.destroy', $blockRegion) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endif
@endsection
