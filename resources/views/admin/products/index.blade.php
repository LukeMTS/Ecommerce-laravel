@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-header">
    <h1>Products Page</h1>
  </div>
  <div class="card-body">
    <table class="table table-bordered trable-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->description }}</td>
          <td>
            <img src="{{ asset('assets/uploads/product/'.$item->image) }}" class="cate-image" alt="Image Here">
          </td>
          <td>
            <a href="{{ url('edit-prod/'.$item->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ url('delete-prod/'.$item->id) }}" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection