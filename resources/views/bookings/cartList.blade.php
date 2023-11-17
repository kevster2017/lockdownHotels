@extends('layouts.app')
@section("content")

<div class="container loginView">

  <div class="col-sm-10">
    <div class="trending-wrapper">
      <h3>Your Cart</h3>

      @foreach($bookings as $booking)
      <div class="row mt-3">
        <div class="col-sm-3">
          <a href="/bookings/show/{{ $booking->id }}">
            <img class="img-fluid" src="/storage/{{ $booking->image }}">

          </a>
        </div>
        <div class="col-sm-6">
          <div class="">
            <h2>{{ $booking->name }}</h2>
            <h5>{{ $booking->description }}</h5>

          </div>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="/removeCart/{{ $booking->cart_id}}" class="btn btn-warning mt-4">Cancel Booking</a>

        </div>

      </div>
      @endforeach
    </div>
    <a class="btn btn-success" href="orderNow">Order Now</a>
  </div>
</div>
@endsection