@extends('layouts.app')

@section('content')

<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>BookingReview</li>
    </ul>
</div>

<div class="container">
    <h1>Review Booking</h1>
</div>

<div class="container mt-3">
    <div class="card mb-3" style="max-width: 1080px;">
        <div class="row g-0">
            <div class="col-md-4">

                <!--
                <img src="/storage/{{ $booking->image }}" class="img-fluid rounded-start" alt="Hotel Image">
-->

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title" id="divLeft">{{ $booking->name }}</h5>
                    <strong><label id="divLeft">Address</label></strong>
                    <p class="card-text" id="divLeft">{{ $booking->address }}</p>
                    <p class="card-text" id="divLeft">{{ $booking->town }}</p>
                    <p class="card-text" id="divLeft">{{ $booking->country }}</p>
                    <p class="card-text" id="divLeft">{{ $booking->postCode }}</p>

                    <p class="card-text"><small class="text-body-secondary">Added to Cart: {{ $booking->created_at }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Booking Details</h5>
        <div class="card-body">
            <p class="card-text" id="divLeft"> {{ $booking->roomType }} room</p>
            <p class="card-text" id="divLeft">Check in: {{ $booking->checkInDate }}</p>
            <p class="card-text" id="divLeft"> {{ $booking->numNights }} nights</p>
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $booking->price }}</strong></p>
        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Extras Details</h5>
        <div class="card-body">
            @if($booking->feat1 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->feat1 }}</p>
            @endif
            @if($booking->feat2 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->feat2 }}</p>
            @endif
            @if($booking->feat3 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->feat3 }}</p>
            @endif
            @if($booking->feat4 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->feat4 }}</p>
            @endif
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $booking->price }}</strong></p>
        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header" id="divLeft">Upgrade Details</h5>
        <div class="card-body">
            @if($booking->upgrade1 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->upgrade1 }}</p>
            @endif
            @if($booking->upgrade2 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->upgrade2 }}</p>
            @endif
            @if($booking->upgrade3 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->upgrade3 }}</p>
            @endif
            @if($booking->upgrade1 == 0 && $booking->upgrade2 == 0 && $booking->upgrade3 == 0)
            <p class="card-text" id="divLeft">No upgrades selected</p>
            @endif
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $booking->price }}</strong></p>
        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header" id="divLeft">Package Details</h5>
        <div class="card-body">
            @if($booking->package1 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->package1 }}</p>
            @endif
            @if($booking->package2 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->package2 }}</p>
            @endif
            @if($booking->package3 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $booking->package3 }}</p>
            @endif
            @if($booking->package1 == 0 && $booking->package2 == 0 && $booking->package3 == 0)
            <p class="card-text" id="divLeft">No packages selected</p>
            @endif
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $booking->price }}</strong></p>
        </div>
    </div>

    <div class="container">
        <a href="{{ route('bookings.stripe') }}" class="btn btn-primary">Book Now for £{{ $booking->price}}</a>
    </div>
</div>
@endsection