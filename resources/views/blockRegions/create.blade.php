@extends('admins.admin')

@section('main-content')
    <h1>Create Block Region</h1>
    <form action="{{ route('blockRegions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('blockRegions.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
