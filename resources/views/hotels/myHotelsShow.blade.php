@extends('layouts/app')

@section('content')


<div class="container mt-3">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-sm-4">
                <img src="/storage/{{ $hotel->image }}" class="img-fluid rounded-start" alt="Hotel Image">
            </div>
            <div class="col-md-8">
                <div class="card-body" id="divLeft">
                    <h2 class="card-title">{{ $hotel->name }}</h2>
                    <p class="card-text">{{ $hotel->address }}</p>
                    <p class="card-text">{{ $hotel->town }}</p>
                    <p class="card-text">{{ $hotel->postCode }}</p>
                    <p class="card-text">{{ $hotel->country }}</p>
                    <p class="card-text"><small class="text-body-secondary">Hotel Added: {{ $hotel->created_at->DiffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Description</h5>
        <div class="card-body">
            <p class="card-text" id="divLeft"> {{ $hotel->description }}</p>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header" id="divLeft">Room Options</h5>
        <div class="card-body" id="divLeft">
            <div class="row">
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Accomodation Type:</strong> {{ $hotel->accomType }}</p>
                    <p id="divLeft"><strong>Room Type:</strong> {{ $hotel->roomType }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> {{ $hotel->price }}</p>
                </div>
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Holiday Type:</strong> {{ $hotel->holidayType }}</p>
                    <p id="divLeft"><strong>Number of Rooms:</strong> {{ $hotel->numRooms }}</p>
                    <p id="divLeft"><strong>Currency Type:</strong> {{ $hotel->currency }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header" id="divLeft">Room Features</h5>
        <div class="card-body" id="divLeft">
            <div class="row">
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Feature 1:</strong> {{ $hotel->feat1 }}</p>
                    <p id="divLeft"><strong>Feature 2:</strong> {{ $hotel->feat2 }}</p>
                    <p id="divLeft"><strong>Feature 3:</strong> {{ $hotel->feat3 }}</p>
                    <p id="divLeft"><strong>Feature 4:</strong> {{ $hotel->feat4 }}</p>
                </div>
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->feat1Price }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->feat2Price }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->feat3Price }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->feat4Price }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header" id="divLeft">Room Upgrades</h5>
        <div class="card-body" id="divLeft">
            <div class="row">
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Upgrade 1:</strong> {{ $hotel->upgrade1 }}</p>
                    <p id="divLeft"><strong>Upgrade 2:</strong> {{ $hotel->upgrade2 }}</p>
                    <p id="divLeft"><strong>Upgrade 3:</strong> {{ $hotel->upgrade3 }}</p>

                </div>
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->upgrade1Price }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->upgrade2Price }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->upgrade3Price }}</p>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header" id="divLeft">Room Packages</h5>
        <div class="card-body" id="divLeft">
            <div class="row">
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Package 1:</strong> {{ $hotel->package1 }}</p>
                    <p id="divLeft"><strong>Package 2:</strong> {{ $hotel->package2 }}</p>
                    <p id="divLeft"><strong>Package 3:</strong> {{ $hotel->package3 }}</p>

                </div>
                <div class="col-sm-6">
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->package1Price }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->package2Price }}</p>
                    <p id="divLeft"><strong>Price Per Night:</strong> £{{ $hotel->package3Price }}</p>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <a class="btn btn-primary" href="{{ route('hotels.edit', $hotel->id) }}">Edit Hotel</a>
    <a class="btn btn-danger" href="{{ route('hotels.destroy', $hotel->id) }}">Delete Booking</a>
</div>




@endsection