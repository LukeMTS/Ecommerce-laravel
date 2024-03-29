@extends('layouts.front')

@section('title')
Category
@endsection

@section('content')
<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>All Categories</h2>
        <div class="row">
          @foreach ($category as $cate)
          <div class="col-md-3 mb-3">
            <a href="{{ url('category/'.$cate->slug) }}">
              <div class="item card">
                <img src="{{ asset('assets/uploads/category/'.$cate->image) }}" class="order-images" alt="Category Image">
                <div class="card-body">
                  <h5 class="order-text">{{ $cate->name }}</h5>
                  <p class="descript-text">
                    {{ $cate->description }}
                  </p>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection