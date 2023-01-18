@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Edit Product</h4>
    </div>
    <div class="card-body">
      <form action="{{ url('update-prod/'.$products->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-12 mb-3">
            <select class="form-select" name="cate_id">
              <option value="">Category</option>
              @foreach ($category as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $products->name }}">
          </div>
          <div class="col-md-6">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $products->slug }}">
          </div>
          <div class="col-md-6">
            <label for="">Small Description</label>
            <input type="text" name="small_description" class="form-control" value="{{ $products->small_description }}">
          </div>
          <div class="col-md-12">
            <label for="">Description</label>
            <textarea name="description" rows="5" class="form-control">{{ $products->description }}</textarea>
          </div>
          <div class="col-md-12">
            <label for="">Original Price</label>
            <input type="number" name="original_price" class="form-control" value="{{ $products->original_price }}">
          </div>
          <div class="col-md-12">
            <label for="">Selling Price</label>
            <input type="number" name="selling_price" class="form-control" value="{{ $products->selling_price }}">
          </div>
          <div class="col-md-3">
            <label for="">Tax</label>
            <input type="number" name="tax" class="form-control" value="{{ $products->tax }}">
          </div>
          <div class="col-md-3">
            <label for="">Quantity</label>
            <input type="number" name="qty" class="form-control" value="{{ $products->qty }}">
          </div>
          <div class="col-md-6">
            <label for="">Status</label>
            <input type="checkbox" name="status" value="checked" {{ $products->status == '1' ? 'checked' : '' }}>
          </div>
          <div class="col-md-3">
            <label for="">Trending</label>
            <input type="checkbox" name="trending" value="checked" {{ $products->trending == '1' ? 'checked' : '' }}>
          </div>
          <div class="col-md-3">
            <label for="">Meta Title</label>
            <input type="text" class="form-control" name="meta_title" value="{{ $products->meta_title }}">
          </div>
          <div class="col-md-3">
            <label for="">Meta Keywords</label>
            <textarea rows="3" class="form-control" name="meta_keywords">{{ $products->meta_keywords }}</textarea>
          </div>
          <div class="col-md-3">
            <label for="">Meta Description</label>
            <textarea rows="3" class="form-control" name="meta_description">{{ $products->meta_description }}</textarea>
          </div>
          <div class="col-md-12">
            @if($products->image)  
              <img src="{{ asset('assets/uploads/product/'.$products->image) }}" alt="Product Image">
            @endif
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