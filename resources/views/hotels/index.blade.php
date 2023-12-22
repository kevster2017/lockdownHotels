@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Hotels</li>
        </ol>
    </nav>
</div>

<div class="container py-3">

    <h1 class="text-center py-3">All Hotels</h1>


    @foreach($hotels as $hotel)
    <div class="row">
        <div class="col-sm-8 mx-auto">

            <!-- List group-->
            <ul class="list-group">

                <!-- list group item-->
                <div class="card text-bg-light mb-3" id="cardStyle">
                    <li class="list-group-item">

                        <div class="my-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a href="{{ route('hotels.show', $hotel->id) }}"><img src="/storage/{{$hotel->image}}" class="img-responsive rounded-start img-fluid" alt="Hotel Image"></a>
                                </div>
                                <div class="col ms-3">
                                    <div class="card-body">

                                        <a href="{{ route('hotels.show', $hotel->id) }}">
                                            <h5 class="card-title">{{ $hotel->name}}</h5>
                                        </a>
                                        @for ($i = 1; $i <= $hotel->stars; $i++)
                                            <span> <i class="fa-solid fa-star mb-3" style="color:gold"></i></span>
                                            @endfor

                                            <p class="card-text">Room Type: {{ $hotel->roomType}}</p>
                                            <p class="card-text">Town: {{ $hotel->town }}</p>
                                            <p class="card-text"><small class="text-muted">Hotel Added: {{ $hotel->created_at->diffForHumans() }}</small></p>

                                    </div>
                                </div>
                            </div>

                            <!-- End -->
                    </li>
                </div>
                <!-- End -->
            </ul>
        </div>
    </div>

    <br>
    @endforeach
</div>
@endsection