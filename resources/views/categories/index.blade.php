@extends('layouts.app')

@section('content')
  
  <div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
  </div>
  <div class="card card-default">
    <div class="card-header">Categories</div>
    <div class="card-body">
      <table class="table">
        <form action="" method="GET"></form>
          <th>ID</th>
          <th>Name</th>
          <th>Actions</th>
          <tbody>
            @foreach ($categories as $category)
              <tr>
                <td>
                  {{ $category->id }}
                </td>
                <td>
                  {{ $category->name }}
                </td>
                <td>
                  <a href="{{ route("$category->id/categories.edit") }}" class="btn btn-primary">Edit</a>
                  <a href="/categories/{{ $category->id }}/delete" class="btn btn-danger">Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </form>
      </table>
    </div>
  </div>

@endsection