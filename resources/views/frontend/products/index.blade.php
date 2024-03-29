@extends('layouts.front')

@section('title')
{{ $category->name }}
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
  <div class="container">
    <h6 class="mb-0">
      <a href="{{ url('category') }}">
        Collections
      </a> /
      <a href="{{ url('category/'.$category->slug) }}">
        {{ $category->name }}
      </a>
    </h6>
  </div>
</div>

<div class="py-5">
  <div class="container">
    <div class="row">
      <h2>{{ $category->name }}</h2>
      @foreach ($products as $prod)
      <div class="col-md-3 mb-3">
        <div class="card">
          <a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}">
            <div class="item card">
              <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="Product Image">
              <div class="card-body">
                <h4 class="order-text">{{ $prod->name }}</h4>
                <span class="float-start text-price">{{ $prod->selling_price }}</span>
                <span class="float-end text-price"> <s> {{ $prod->original_price }}</s></span>
              </div>
          </div>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection