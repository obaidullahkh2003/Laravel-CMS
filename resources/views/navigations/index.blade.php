@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container mt-4">
        <h1>Navigation Items</h1>
        @if(in_array('add navigation', array_keys($permissionsArray)))
        <a href="{{ route('navigations.create') }}" class="btn btn-primary mt-3 mb-3">Create New Navigation</a>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
            <tr>
                <th>Label</th>
                <th>URL</th>
                <th>Order</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($navigations as $navigation)
                <tr>
                    <td>{{ $navigation->label }}</td>
                    <td>{{ $navigation->url }}</td>
                    <td>{{ $navigation->order }}</td>
                    <td>{{ $navigation->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        @if(in_array('edit navigation', array_keys($permissionsArray)))
                        <a href="{{ route('navigations.edit', $navigation) }}" class="btn btn-warning">Edit</a>
                        @endif
                            @if(in_array('delete navigation', array_keys($permissionsArray)))
                            <form action="{{ route('navigations.destroy', $navigation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                        </form>
                            @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
        {{ $navigations->links() }}
        </div>
    </div>
@endsection
