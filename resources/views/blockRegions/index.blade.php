@extends('admins.admin')

@section('main-content')
    <h1>Block Regions</h1>
    <a href="{{ route('blockRegions.create') }}" class="btn btn-primary mt-3 mb3">Create New Block Region</a>

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($blockRegions as $blockRegion)
            <tr>
                <td>{{ $blockRegion->id }}</td>
                <td>{{ $blockRegion->name }}</td>
                <td>
                    <a href="{{ route('blockRegions.show', $blockRegion) }}" class="btn btn-info">View</a>
                    <a href="{{ route('blockRegions.edit', $blockRegion) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('blockRegions.destroy', $blockRegion) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-3 d-flex justify-content-center">
        {{ $blockRegions->links() }}
    </div>
@endsection
