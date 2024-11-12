@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>Users</h1>
        @if(in_array('add user', array_keys($permissionsArray)))
        <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Add User</a>
        @endif
        @if(session('success'))
            <div class="alert alert-success mb-3 mt-3">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('user.show', $user) }}" class="btn btn-info">View</a>
                        @if(in_array('edit user', array_keys($permissionsArray)))
                        <a href="{{ route('user.edit', $user) }}" class="btn btn-warning">Edit</a>
                        @endif
                        @if(in_array('delete user', array_keys($permissionsArray)))
                        <form action="{{ route('user.destroy', $user) }}" method="POST" style="
                        display:inline;" onsubmit="return confirmDelete(event);">
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
            {{ $users->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(event) {
            if (!confirm("Are you sure you want to delete this user?")) {
                event.preventDefault();
            }
        }
    </script>
@endsection
