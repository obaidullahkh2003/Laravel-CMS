@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Timeline Events</h1>
        @if(in_array('create timeline', array_keys($permissionsArray)))
        <a href="{{ route('timeline-events.create') }}" class="btn btn-primary mt-3 mb-3">Add New Event</a>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Subheading</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($timelineEvents as $timelineEvent)
                <tr>
                    <td>{{ $timelineEvent->title }}</td>
                    <td>{{ \Str::words($timelineEvent->subheading, 5, '...') }}</td> <!-- Limit subheading to 20 words -->
                    <td>{{ $timelineEvent->start_date }}</td>
                    <td>{{ $timelineEvent->end_date }}</td>
                    <td>{{ $timelineEvent->is_active ? 'Active' : 'Inactive' }}</td>

                    <td>
                        @if($timelineEvent->image)
                            <img src="{{ asset('storage/' . $timelineEvent->image) }}" alt="Image" width="50" class="img-fluid">
                        @else
                            No image
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('timeline-events.show', $timelineEvent) }}" class="btn btn-info">View</a>
                        @if(in_array('edit timeline', array_keys($permissionsArray)))
                        <a href="{{ route('timeline-events.edit', $timelineEvent) }}" class="btn btn-warning">Edit</a>
                        @endif
                        @if(in_array('delete timeline', array_keys($permissionsArray)))
                        <form action="{{ route('timeline-events.destroy', $timelineEvent) }}" method="POST" style="display:inline;">
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
            {{ $timelineEvents->links() }}
        </div>
    </div>
@endsection
