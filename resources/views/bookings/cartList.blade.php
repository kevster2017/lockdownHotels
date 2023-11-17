@extends('layouts.app')
@section("content")

<div class="container loginView">

  <div class="col-sm-10">
    <div class="trending-wrapper">
      <h3>Your Cart</h3>

    </div>

    @foreach($bookings as $booking)
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4">

          <img src="/storage/{{ $booking->image }}" class="img-fluid rounded-start" alt="Hotel Image">

        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{ $booking->name }}</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

            <p class="card-text"><small class="text-body-secondary">Added to Cart: {{ $booking->created_at }}</small></p>
          </div>
        </div>
      </div>
    </div>

    @endforeach
    <div class="row">
      <a href="/removeCart/{{ $booking->cart_id}}" class="btn btn-warning mt-4">Cancel Booking</a>
      <a class="btn btn-success mt-4" href="{{ route('bookings.review') }}">Order Now</a>
    </div>

  </div>
</div>
@endsection