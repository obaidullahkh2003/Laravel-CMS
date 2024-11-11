@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Admins</h1>
        <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Add Admin</a>

        @if(session('success'))
            <div class="alert alert-success mb-3 mt-3">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th> <!-- Added Role Column -->
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->roles->isEmpty())
                            No Roles
                        @else
                            {{ $user->roles->first()->name }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.show', $user) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.edit', $user) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event);">
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
            {{ $users->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(event) {
            if (!confirm("Are you sure you want to delete this Admin?")) {
                event.preventDefault();
            }
        }
    </script>
@endsection
