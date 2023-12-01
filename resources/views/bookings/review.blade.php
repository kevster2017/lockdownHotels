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


                <img src="/storage/{{ $cart->image }}" class="img-fluid rounded-start" alt="Hotel Image">


            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title" id="divLeft">{{ $cart->name }}</h5>
                    <strong><label id="divLeft">Address</label></strong>
                    <p class="card-text" id="divLeft">{{ $cart->address }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->town }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->country }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->postCode }}</p>

                    <p class="card-text"><small class="text-body-secondary">Booking Created: {{ $cart->created_at }}</small></p>
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
            <p class="card-text" id="divLeft"><strong>Hotel Price: £{{ $cart->price * $cart->numNights }}</strong></p>
        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Extras Details</h5>
        <div class="card-body">
            @if($cart->selectedFeat1 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat1 }}, £{{ $cart->feat1Price}} per night</p>
            @endif
            @if($cart->selectedFeat2 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat2 }}, £{{ $cart->feat2Price}} per night</p>
            @endif
            @if($cart->selectedFeat3 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat3 }}, £{{ $cart->feat3Price}} per night</p>
            @endif
            @if($cart->selectedFeat4 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat4 }}, £{{ $cart->feat4Price}} per night</p>
            @endif
            @if($cart->featuresTotal != 0)
            <p class="card-text" id="divLeft"><strong>Extras Price: £{{ $cart->feat2Price * $cart->numNights }}</strong></p>
            @else
            <p class="card-text" id="divLeft"><strong>{{ "No extras added" }}</strong></p>
            @endif
        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header" id="divLeft">Upgrade Details</h5>
        <div class="card-body">
            @if($cart->upgradeTotal == 0)
            <p class="card-text" id="divLeft"><strong>{{ "No upgrade added" }}</strong></p>
            @else

            <p class="card-text" id="divLeft">Upgrade:1{{ $cart->selectedUpgrade }}</p>
            <p class="card-text" id="divLeft"><strong>Total Upgrade Price: £{{ $cart->upgradeTotal }}</strong></p>

            @endif

        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header" id="divLeft">Package Details</h5>
        <div class="card-body">
            @if($cart->packageTotal == 0)
            <p class="card-text" id="divLeft"><strong>{{ "No package added" }}</strong></p>
            @else
            <p class="card-text" id="divLeft">Package: {{ $cart->selectedPackage }}</p>
            <p class="card-text" id="divLeft"><strong>Total Package Price: £{{ $cart->packageTotal }}</strong></p>
            @endif

        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header" id="divLeft">Final Total</h5>
        <div class="card-body">
            <h3><strong>Final Total: £</strong>{{ $cart->finalTotal}}</h3>
        </div>
    </div>

    <div class="container">
        <a href="{{ route('bookings.stripe') }}" class="btn btn-primary">Book Now for £{{ $cart->finalTotal}}</a>
    </div>
</div>
@endsection