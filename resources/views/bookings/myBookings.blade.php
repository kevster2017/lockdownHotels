@extends('layouts.app')
@section("content")





<h1 class="text-center pb-3">My Bookings</h1>

<div class="container mt-5 d-flex justify-content-center">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Booking ID</th>
        <th scope="col">Product</th>
        <th scope="col">Title</th>
        <th scope="col">Address</th>
        <th scope="col">Payment Method</th>
        <th scope="col">Payment Status</th>
        <th scope="col">Status</th>
        <th scope="col">Booking Placed</th>
        <th scope="col">Booking Updated</th>

      </tr>
    </thead>
    <tbody>


      @foreach($bookings as $booking)
      <tr>

        <th scope="row">{{ $booking->booking_id }}</a></th>

        <td><img class="trending-img" src="/storage/{{ $booking->image }}"></td>
        <td>{{ $booking->hotelName }}</td>
        <td>{{ $booking->country }}</td>
        <td>{{ $booking->checkInDate }}</td>
        <td>{{ $booking->numNights }}</td>
        <td>{{ $booking->payment_method }}</td>
        <td>{{ $booking->paid }}</td>
        <td>{{ date('d-m-Y', strtotime($booking->created_at));  }}</td>
        <td>{{ date('d-m-Y', strtotime($booking->updated_at)); }}</td>


      </tr>

      @endforeach


    </tbody>
  </table>



</div>
<div class="pagination justify-content-center">
  {{ $bookings->links() }}
</div>

@endsection