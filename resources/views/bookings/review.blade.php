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
                <img src="/storage/{{ $cart->image }}" class="img-fluid rounded-start" alt="Hotel Image">
-->

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title" id="divLeft">{{ $cart->name }}</h5>
                    <strong><label id="divLeft">Address</label></strong>
                    <p class="card-text" id="divLeft">{{ $cart->address }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->town }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->country }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->postCode }}</p>

                    <p class="card-text"><small class="text-body-secondary">Added to Cart: {{ $cart->created_at }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Booking Details</h5>
        <div class="card-body">
            <p class="card-text" id="divLeft"> {{ $cart->roomType }} room</p>
            <p class="card-text" id="divLeft">Check in: {{ $cart->checkInDate }}</p>
            <p class="card-text" id="divLeft"> {{ $cart->numNights }} nights</p>
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $cart->price }}</strong></p>
        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Extras Details</h5>
        <div class="card-body">
            @if($cart->feat1 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat1 }}</p>
            @endif
            @if($cart->feat2 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat2 }}</p>
            @endif
            @if($cart->feat3 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat3 }}</p>
            @endif
            @if($cart->feat4 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat4 }}</p>
            @endif
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $cart->price }}</strong></p>
        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header" id="divLeft">Upgrade Details</h5>
        <div class="card-body">
            @if($cart->upgrade1 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->upgrade1 }}</p>
            @endif
            @if($cart->upgrade2 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->upgrade2 }}</p>
            @endif
            @if($cart->upgrade3 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->upgrade3 }}</p>
            @endif
            @if($cart->upgrade1 == 0 && $cart->upgrade2 == 0 && $cart->upgrade3 == 0)
            <p class="card-text" id="divLeft">No upgrades selected</p>
            @endif
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $cart->price }}</strong></p>
        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header" id="divLeft">Package Details</h5>
        <div class="card-body">
            @if($cart->package1 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->package1 }}</p>
            @endif
            @if($cart->package2 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->package2 }}</p>
            @endif
            @if($cart->package3 != 0)
            <p class="card-text" id="divLeft">Feature: {{ $cart->package3 }}</p>
            @endif
            @if($cart->package1 == 0 && $cart->package2 == 0 && $cart->package3 == 0)
            <p class="card-text" id="divLeft">No packages selected</p>
            @endif
            <p class="card-text" id="divLeft"><strong>Total Price: £{{ $cart->price }}</strong></p>
        </div>
    </div>

    <div class="container">
        <a href="#" class="btn btn-primary">Book Now for £{{ $cart->price}}</a>
    </div>
</div>
@endsection