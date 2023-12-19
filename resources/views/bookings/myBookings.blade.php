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

  @if($bookings->count() == 0)

  <h2 class="text-center">No Bookings Available</h2>

  @else

  @foreach($bookings as $booking)
  <div class="row">
    <div class="col-sm-8 mx-auto">

      <!-- List group-->
      <ul class="list-group">
        <div class="cardStyle">
          <!-- list group item-->
          <li class="list-group-item">

            <div class="my-2">
              <div class="row g-0">
                <div class="col-sm-6 d-flex">
                  <a href="{{ route('bookings.show', $booking->id) }}"><img src="/storage/{{$booking->image}} " class="img-responsive rounded-start" alt="Hotel Image"></a>
                </div>
                <div class="col-sm-6 d-flex">
                  <div class="card-body">
                    <a href="{{ route('bookings.show', $booking->id) }}">
                      <h5 class="card-title">{{ $booking->name}}</h5>
                    </a>
                    <p class="card-text">Booking ID: {{ $booking->id}}</p>
                    <p class="card-text">Country: {{ $booking->country }}</p>
                    <p class="card-text">Check-in: {{ date('d-m-Y', strtotime($booking->checkInDate));  }}
                    </p>
                    <p class="card-text">{{ $booking->numNights }} nights</p>
                    <p class="card-text">Payment: {{ $booking->payment_method }}</p>
                    <p class="card-text"><small class="text-muted">Booking Created: {{ date('d-m-Y', strtotime($booking->created_at)); }}</small></p>
                  </div>
                </div>
              </div>
            </div>

            <!-- End -->
          </li>
        </div>
        <!-- End -->
      </ul>
    </div>
  </div>

  <br>
  @endforeach

  @endif
</div>
@endsection