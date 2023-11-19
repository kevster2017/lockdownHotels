@extends('layouts/app')

@section('content')


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
                    <p class="card-text"><small class="text-body-secondary">Hotel Added: {{ $booking->created_at->DiffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3">

    <div class="card">
        <h5 class="card-header" id="divLeft">Description</h5>
        <div class="card-body">
            <p class="card-text" id="divLeft"> {{ $booking->description }}</p>
        </div>
    </div>
</div>



@endsection