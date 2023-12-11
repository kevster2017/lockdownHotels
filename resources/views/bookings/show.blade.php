@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('myBookings') }}">My Bookings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Your booking at {{ $booking->name }}</li>
        </ol>
    </nav>
</div>

<div class="container mt-3">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-sm-4">
                <img src="/storage/{{ $booking->image }}" class="img-fluid rounded-start" alt="Hotel Image">
            </div>
            <div class="col-md-8">
                <div class="card-body" id="divLeft">
                    <h2 class="card-title">{{ $booking->name }}</h2>
                    <p class="card-text">{{ $booking->address }}</p>
                    <p class="card-text">{{ $booking->town }}</p>
                    <p class="card-text">{{ $booking->postCode }}</p>
                    <p class="card-text">{{ $booking->country }}</p>
                    <p class="card-text"><small class="text-body-secondary">Booking Created: {{ $booking->created_at->DiffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Booking Details</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <p class="card-text" id="divLeft"><strong>Check in date: </strong> {{ date('d-m-Y', strtotime($booking->checkInDate));  }}</p>

                </div>
                <div class="col-sm-4">
                    <p class="card-text" id="divLeft"><strong>Room: </strong> {{ $booking->roomType }} room</p>
                </div>
                <div class="col-sm-4">
                    <p class="card-text" id="divLeft"><strong>Number of nights: </strong> {{ $booking->numNights }}</p>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Cost Breakdown</h5>
        <div class="card-body">



            <div class="row">

                <div class="col-sm-4">
                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-transparent border-dark">Hotel Costs</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title">Price Per Night: £{{ $booking->price / $booking->numNights }}</h5>

                        </div>
                        <div class="card-footer bg-transparent border-dark"><strong>Total Hotel Costs:</strong> £{{ $booking->price }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-transparent border-dark">Extras Costs</div>
                        <div class="card-body text-dark">

                            @if($booking->extrasTotal == 0)
                            <h5 class="card-title">No Extras Purchased </h5>
                            @else
                            @if($booking->selectedFeat1 != 'None')
                            <h5 class="card-title">{{ $booking->feat1 }}: £{{$booking->feat1Price * $booking->numNights }} </h5>

                            @endif
                            @if($booking-> selectedFeat2 != 'None')
                            <h5 class="card-title">{{ $booking->feat2 }}: £{{$booking->feat2Price * $booking->numNights }} </h5>

                            @endif
                            @if($booking-> selectedFeat3 != 'None')
                            <h5 class="card-title">{{ $booking->feat3 }}: £{{$booking->feat3Price * $booking->numNights }} </h5>

                            @endif
                            @if($booking-> selectedFeat4 != 'None')
                            <h5 class="card-title">{{ $booking->feat4 }}: £{{$booking->feat4Price * $booking->numNights }} </h5>

                            @endif
                            @if($booking-> selectedUpgrade != 'None')
                            <h5 class="card-title">{{ $booking->selectedUpgrade }}: £{{$booking->upgradeTotal * $booking->numNights }} </h5>

                            @endif
                            @if($booking-> selectedPackage != 'None')
                            <h5 class="card-title">{{ $booking->selectedPackage }}: £{{$booking->packageTotal * $booking->numNights }} </h5>

                            @endif
                            @endif

                        </div>
                        <div class="card-footer bg-transparent border-dark"><strong>Total Extras Costs:</strong> £{{ $booking->extrasTotal }}</div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-transparent border-dark">Total Costs</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title">Hotel Costs: £{{ $booking->price * $booking->numNights }}</h5>
                            <h5 class="card-title">Feature Costs: £{{ $booking->featuresTotal }}</h5>
                            <h5 class="card-title">Upgrade Costs: £{{ $booking->upgradeTotal }}</h5>
                            <h5 class="card-title">Package Costs: £{{ $booking->packageTotal }}</h5>

                        </div>
                        <div class="card-footer bg-transparent border-dark"><strong>Total Costs:</strong> £{{ $booking->finalTotal }}</div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <a class="btn btn-primary" href="{{ route('bookings.edit', $booking->id) }}">Edit Booking</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $booking->id }}">
            Delete Booking
        </button>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal{{ $booking->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to delete this booking?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Deleting is permanent and cannot be undone</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>



@endsection