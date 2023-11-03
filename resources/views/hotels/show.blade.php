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
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Room Type</th>
                        <th scope="col">Extras</th>
                        <th scope="col">Price</th>
                        <th scope="col">Available Rooms</th>
                        <th scope="col">Book Now</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{ $hotel->roomType }}</th>
                        <table class="table">
                            <tr>
                                <td>{{ $hotel->feat1 }} +£{{ $hotel->feat1Price }}</td>
                            </tr>
                            <tr>
                                <td>{{ $hotel->feat2 }} +£{{ $hotel->feat2Price }}</td>
                            </tr>
                            <tr>
                                <td>{{ $hotel->feat3 }} +£{{ $hotel->feat3Price }}</td>
                            </tr>
                            <tr>
                                <td>{{ $hotel->feat4 }} +£{{ $hotel->feat4Price }}</td>
                            </tr>



                        </table>

                        <td>{{ $hotel->price }}</td>
                        <td>{{ $hotel->numRooms }}</td>
                        <td><a href="#" class="btn btn-primary">Book Now</a></td>
                    </tr>

                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection