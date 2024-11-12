@extends('admins.admin')

@section('main-content')
    <div class="container">
        <h1>Article</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(in_array('add article', array_keys($permissionsArray)))
        <a href="{{ route('article.create') }}" class="btn btn-primary mb-3">Create New Article</a>
        @endif
        <table class="table mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ Str::limit($article->content, 50) }}</td>
                    <td>
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" width="50">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        @if($article->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Unpublished</span>
                        @endif
                    </td>
                    <td>
                        @if(in_array('edit article', array_keys($permissionsArray)))
                        <a href="{{ route('article.edit', $article->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                        @if(in_array('delete article', array_keys($permissionsArray)))
                        <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display:inline;">
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
        {{-- Pagination Links --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
