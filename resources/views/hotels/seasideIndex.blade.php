@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container text-center mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Seaside Hotels</li>
        </ol>
    </nav>

    <h1 class="py-3">Seaside Hotels</h1>
</div>

@foreach($hotels as $hotel)
<div class="container d-flex justify-content-center mt-3">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-sm-4">
                <a href="{{ route('hotels.show', $hotel->id) }}"><img src="/storage/{{$hotel->image}} " class="img-responsive rounded-start " alt="Hotel Image"></a>
            </div>
            <div class="col-sm-8">
                <div class="card-body">
                    <a href="{{ route('hotels.show', $hotel->id) }}">
                        <h5 class="card-title">Name: {{ $hotel->name}}</h5>
                    </a>

                    <p class="card-text">Description: {{ $hotel->description }}</p>
                    <p class="card-text">Home Town: {{ $hotel->town }}</p>
                    <p class="card-text"><small class="text-muted">Hotel Added: {{ $hotel->created_at-> diffforhumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection