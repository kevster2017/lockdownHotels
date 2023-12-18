@extends('layouts.app')
@section("content")


<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">My Bookings</li>
    </ol>
  </nav>
</div>



<h1 class="text-center pb-3">My Bookings</h1>

<div class="container mt-5 d-flex justify-content-center">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Booking ID</th>
        <th scope="col">Hotel</th>
        <th scope="col">Name</th>
        <th scope="col">Country</th>
        <th scope="col">Check In</th>
        <th scope="col">Nights</th>
        <th scope="col">Method of Payment</th>
        <th scope="col">Booking Date</th>

      </tr>
    </thead>
    <tbody>


      @foreach($bookings as $booking)

      <tr>

        <th scope="row">{{ $booking->booking_id }}
        </th>

        <td><a href="{{ route('bookings.show', $booking->id) }}"><img class=" trending-img" src="/storage/{{ $booking->image }}"> </a></td>
        <td>{{ $booking->name }}</td>
        <td>{{ $booking->country }}</td>
        <td>{{ date('d-m-Y', strtotime($booking->checkInDate));  }}</td>
        <td>{{ $booking->numNights }}</td>
        <td>{{ $booking->payment_method }}</td>
        <td>{{ date('d-m-Y', strtotime($booking->created_at));  }}</td>




      </tr>




      @endforeach


    </tbody>
  </table>



</div>
<div class="pagination justify-content-center mt-4">
  {{ $bookings->links() }}
</div>

@endsection