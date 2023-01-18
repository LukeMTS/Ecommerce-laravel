@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Add Product</h4>
    </div>
    <div class="card-body">
      <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12 mb-3">
            <select class="form-select" name="cate_id">
              <option value="">Select a Category</option>
              @foreach ($category as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="col-md-6">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control">
          </div>
          <div class="col-md-6">
            <label for="">Small Description</label>
            <input type="text" name="small_description" class="form-control">
          </div>
          <div class="col-md-12">
            <label for="">Description</label>
            <textarea name="description" rows="5" class="form-control"></textarea>
          </div>
          <div class="col-md-12">
            <label for="">Original Price</label>
            <input type="number" name="original_price" class="form-control">
          </div>
          <div class="col-md-12">
            <label for="">Selling Price</label>
            <input type="number" name="selling_price" class="form-control">
          </div>
          <div class="col-md-3">
            <label for="">Tax</label>
            <input type="number" name="tax" class="form-control">
          </div>
          <div class="col-md-3">
            <label for="">Quantity</label>
            <input type="number" name="qty" class="form-control">
          </div>
          <div class="col-md-6">
            <label for="">Status</label>
            <input name="status" type="checkbox" >
          </div>
          <div class="col-md-3">
            <label for="">Trending</label>
            <input  name="trending" type="checkbox">
          </div>
          <div class="col-md-3">
            <label for="">Meta Title</label>
            <input type="text" class="form-control" name="meta_title">
          </div>
          <div class="col-md-3">
            <label for="">Meta Keywords</label>
            <textarea rows="3" class="form-control" name="meta_keywords"></textarea>
          </div>
          <div class="col-md-3">
            <label for="">Meta Description</label>
            <textarea rows="3" class="form-control" name="meta_description"></textarea>
          </div>
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