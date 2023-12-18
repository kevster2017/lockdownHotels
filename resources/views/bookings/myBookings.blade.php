@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">My Bookings</li>
    </ol>
  </nav>
</div>

<div class="container py-3">

  <h1 class="text-center py-3">My Bookings</h1>

  @foreach($bookings as $booking)
  <div class="row">
    <div class="col-sm-8 mx-auto">

      <!-- List group-->
      <ul class="list-group" id="indexCard">

        <!-- list group item-->
        <li class="list-group-item">

          <div class="my-2">
            <div class="row g-0">
              <div class="col">
                <a href="{{ route('bookings.myBookings', $booking->id) }}"><img src="/uploads/{{$booking->image}} " class="img-responsive rounded-start" alt="Hotel Image"></a>
              </div>
              <div class="col ms-3 pt-3">
                <div class="card-body">
                  <a href="{{ route('bookings.show', $booking->id) }}">
                    <h5 class="card-title">Name: {{ $hotel->name}}</h5>
                  </a>
                  <p class="card-text">Description: {{ $booking->id}}</p>
                  <p class="card-text">Country: {{ $booking->country }}</p>
                  <p class="card-text">Check-in: {{ date('d-m-Y', strtotime($booking->checkInDate));  }}
                    p>
                  <p class="card-text"> {{ $booking->numNights
 }} nights</p>
                  <p class="card-text">Payment: {{ $booking->payment_method 
 }}</p>
                  <p class="card-text"><small class="text-muted">Booking Created: {{ $booking->created_at-> diffforhumans() }}</small></p>
                </div>
              </div>
            </div>
          </div>

          <!-- End -->
        </li>
        <!-- End -->
      </ul>
    </div>
  </div>
  <br>
  @endforeach
  @endsection