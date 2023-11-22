@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All hotels</li>
        </ol>
    </nav>
</div>



<h1 class="text-center py-3">All hotels</h1>


@foreach($hotels as $hotel)
<div class="container d-flex justify-content-center mt-3">
    <div class="card w-75">
        <div class="row g-0">
            <div class="col-12 col-sm-4 order-sm-1">
                <a href="{{ route('hotels.show', $hotel->id) }}"><img src="/storage/{{$hotel->image}}" class="img-responsive rounded-start img-fluid" alt="Hotel Image"></a>
            </div>
            <div class="col-12 col-sm-8 order-sm-2">
                <div class="card-body divLeft">
                    <a href="{{ route('hotels.show', $hotel->id) }}">
                        <h5 class="card-title">{{ $hotel->name}}</h5>
                    </a>

                    <p class="card-text">Room Type: {{ $hotel->roomType}}</p>
                    <p class="card-text">Town: {{ $hotel->town }}</p>
                    <p class="card-text"><small class="text-muted">Hotel Added: {{ $hotel->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection