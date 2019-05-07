@extends('layouts.app')

@section('content')
  
  <div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
  </div>
  <div class="card card-default">
    <div class="card-header">Posts</div>
    <div class="card-body">
      @if($posts->count() > 0)
        <table class="table">
          <form action="" method="GET"></form>
            <th>ID</th>
            {{-- <th>Image</th> --}}
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
            <tbody>
              @foreach($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  {{-- <td><img src="{‌{ asset('/storage/'.$post->image) }}" /><td> --}}
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->description }}</td>
                  @if(!$post->trashed())
                    <td><a href="#" class="btn btn-primary btn-sm">Edit</a></td>
                  @endif
                  <td>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                          {{ $post->trashed() ? 'Delete' : 'Trash' }}
                        </button>                  
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </form>
        </table>
      @else
        <h4 class="text-center">No posts yet</h4>
      @endif

      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="" method="POST" id="deletePostForm">
              @method('DELETE')
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="text-center text-bold">
                    Are you sure you wanto to delete this post?
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                  <button type="submit" class="btn btn-danger">Yes, delete</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script>
    function handleDelete(id) {
      $('#deleteModal').modal('show');

      var form = document.getElementById('deletePostForm')
      form.action = '/posts/' + id
    }
  </script>
@endsection