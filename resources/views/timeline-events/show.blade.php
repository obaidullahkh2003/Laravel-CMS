@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>{{ $timelineEvent->title }}</h1>
        <p><strong>Subheading:</strong> {{ $timelineEvent->subheading }}</p>
        <p><strong>Start Date:</strong> {{ $timelineEvent->start_date }}</p>
        <p><strong>End Date:</strong> {{ $timelineEvent->end_date }}</p>
        <p><strong>Status:</strong> {{ $timelineEvent->is_active ? 'Active' : 'Inactive' }}</p>
        @if ($timelineEvent->image)
            <p><strong>Image:</strong>
                <br>
            <img src="{{ asset('storage/' . $timelineEvent->image) }}" alt="Event Image" class="img-fluid mt-3">
        @endif
        <div class="mt-3">
            @if(in_array('edit timeline', array_keys($permissionsArray)))
            <a href="{{ route('timeline-events.edit', $timelineEvent) }}" class="btn btn-warning">Edit</a>
            @endif
        <a href="{{ route('timeline-events.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
