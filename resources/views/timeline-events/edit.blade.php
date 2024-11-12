@extends('admins.admin')

@section('main-content')
    @php
        $permissionsArray = getPermissionsArray();
    @endphp
    <div class="container">
        <h1>Edit Timeline Event</h1>
        <form action="{{ route('timeline-events.update', $timelineEvent) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $timelineEvent->title }}" required>
            </div>

            <div class="form-group">
                <label for="subheading">Subheading</label>
                <input type="text" class="form-control" name="subheading" id="subheading" value="{{ $timelineEvent->subheading }}">
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $timelineEvent->start_date }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $timelineEvent->end_date }}">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="is_active" {{ $timelineEvent->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
                @if($timelineEvent->image)
                    <div class="mt-2">
                        <label>Current Image:</label><br>
                        <img src="{{ asset('storage/' . $timelineEvent->image) }}" alt="Current Image" width="200" class="img-fluid">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>
@endsection
