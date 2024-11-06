@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Create Timeline Event</h1>
        <form action="{{ route('timeline-events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="subheading">Subheading</label>
                <input type="text" class="form-control" name="subheading" id="subheading">
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date">
            </div>
            <div class="form-group">
                <label for="image">Event Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="is_active">
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Create Event</button>
        </form>
    </div>
@endsection
