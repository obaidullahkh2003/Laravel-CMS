@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>Roles</h1>
        @if(in_array('create role', array_keys($permissionsArray)))
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
        @endif
        @if(session('success'))
            <div class="alert alert-success mt-3 mb-3">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.show', $role) }}" class="btn btn-info">View</a>
                        @if(in_array('edit role', array_keys($permissionsArray)))
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit</a>
                        @endif
                        @if(in_array('delete role', array_keys($permissionsArray)))
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline;">
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

        {{-- Pagination Links --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $roles->links() }}
        </div>
    </div>
@endsection
