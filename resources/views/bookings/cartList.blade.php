@extends('layouts.app')
@section("content")

<div class="container loginView">

  <div class="col-sm-10">
    <div class="trending-wrapper">
      <h3>Your Cart</h3>

      @foreach($products as $product)
      <div class="row searched-item cart-list-divider">
        <div class="col-sm-3">
          <a href="/orders/show/{{ $product->id }}">
            <img class="img-fluid" src="/storage/{{ $product->image }}">

          </a>
        </div>
        <div class="col-sm-6">
          <div class="">
            <h2>{{ $product->name }}</h2>
            <h5>{{ $product->description }}</h5>

          </div>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="/removeCart/{{ $product->cart_id}}" class="btn btn-warning mt-4">Remove from Cart</a>

        </div>

      </div>
      @endforeach
    </div>
    <a class="btn btn-success" href="orderNow">Order Now</a>
  </div>
</div>
@endsection