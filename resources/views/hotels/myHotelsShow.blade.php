@extends('layouts/app')

@section('content')

<!-- Page Content -->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('myHotels') }}">My Properties</a></li>
            <li class="breadcrumb-item active" aria-current="page">Your property at {{ $hotel->name }}</li>
        </ol>
    </nav>
</div>

<div class="container text-center mt-5">
    <h1>{{ $hotel->name }}</h1>
</div>

<div class="container mt-5">
    <div class="card text-bg-light mb-3">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <img src="/storage/{{ $hotel->image }}" class="img-fluid rounded-start" alt="Hotel Image">
            </div>
            <div class="col-sm-8">
                <div class="card-body" id="divLeft">
                    <h2 class="card-title">{{ $hotel->name }}</h2>
                    @for ($i = 1; $i <= $hotel->stars; $i++)
                        <span> <i class="fa-solid fa-star mb-3" style="color:gold"></i></span>
                        @endfor
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

    <div class="card text-bg-light mb-3">
        <h5 class="card-header" id="divLeft">Description</h5>
        <div class="card-body">
            <p class="card-text" id="divLeft"> {{ $hotel->description }}</p>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card text-bg-light mb-3">
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
    <div class="card text-bg-light mb-3">
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
    <div class="card text-bg-light mb-3">
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
    <div class="card text-bg-light mb-3">
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

<div class="container text-center">
    <a class="btn btn-primary" href="{{ route('hotels.edit', $hotel->id) }}">Edit Hotel</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
        Delete Hotel
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to delete {{ $hotel->name }}?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Deleting is permanent and cannot be undone</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="POST" action="{{ route('hotels.destroy', $hotel->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete Hotel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>




@endsection