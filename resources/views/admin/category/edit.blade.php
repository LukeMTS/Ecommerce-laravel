@extends('layouts.admin')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Edit Category</h4>
    </div>
    <div class="card-body">
      <form action="{{ url('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-6">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
          </div>
          <div class="col-md-6">
            <label for="">Slug</label>
            <input type="text" class="form-control" name="slug" value="{{ $category->slug }}">
          </div>
          <div class="col-md-12">
            <label for="">Description</label>
            <textarea name="description" rows="5" class="form-control">{{ $category->description }}</textarea>
          </div>
          <div class="col-md-6">
            <label for="">Status</label>
            <input type="checkbox" name="status"  value="checked" {{ $category->status == '1' ? 'checked' : '' }}>
          </div>
          <div class="col-md-6">
            <label for="">Popular</label>
            <input type="checkbox" name="popular" value="checked" {{ $category->popular == '1' ? 'checked' : '' }}>
          </div>
          <div class="col-md-3">
            <label for="">Meta title</label>
            <input type="text" class="form-control" name="meta_title" value="{{ $category->meta_title }}">
          </div>
          <div class="col-md-3">
            <label for="">Meta keywords</label>
            <textarea rows="3" class="form-control" name="meta_keywords">{{ $category->meta_keywords }}</textarea>
          </div>
          <div class="col-md-3">
            <label for="">Meta descrip</label>
            <textarea rows="3" class="form-control" name="meta_descrip">{{ $category->meta_descrip }}</textarea>
          </div>
          @if($category->image)
            <img src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="Category Image">
          @endif
          <div class="col-md-12">
            <input type="file" name="image">
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
