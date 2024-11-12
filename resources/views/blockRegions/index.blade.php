@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <h1>Block Regions</h1>
    @if(in_array('add region', array_keys($permissionsArray)))
        <a href="{{ route('blockRegions.create') }}" class="btn btn-primary mt-3 mb3">Create New Block Region</a>
    @endif
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-3 d-flex justify-content-center">
        {{ $blockRegions->links() }}
    </div>
@endsection
