@extends('layouts.front')

@section('title')
Welcome to E-shop
@endsection

@section('content')
@include('layouts.inc.slider')

<div class="py-5">
  <div class="container">
    <div class="row">
      <h2>Featured Products</h2>

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          @foreach ($featured_products as $key => $prod)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img class="d-block w-100" src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="Product Image">
          </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <!-- <div class="owl-carousel featured-carousel owl-theme">
        @foreach ($featured_products as $prod)
        <div class="item">
          <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
            <div class="card">
              <img class="" src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="Product Image">
              <div class="card-body">
                <h5>{{ $prod->name }}</h5>
                <span class="float-start">{{ $prod->selling_price }}</span>
                <small class="float-end"> <s> {{ $prod->original_price }}</s></small>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div> -->
    </div>
  </div>
</div>

<div class="py-5">
  <div class="container">
    <div class="row">
      <h2>Trending Category</h2>
      <div class="owl-carousel featured-carousel owl-theme">
        @foreach ($trending_category as $tcategory)
        <div class="item">
          <a href="{{ url('category/'.$tcategory->slug) }}">
            <div class="card">
              <img src="{{ asset('assets/uploads/category/'.$tcategory->image) }}" alt="Category Image">
              <div class="card-body">
                <h5>{{ $tcategory->name }}</h5>
                <p>
                  {{ $tcategory->description }}
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
@endsection

@section('scripts')
<script>
  $('.featured-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 5
      }
    }
  })
</script>
@endsection