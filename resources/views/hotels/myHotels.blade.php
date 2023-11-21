@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Hotels</li>
        </ol>
    </nav>
</div>

<div class="container py-3">


    <h1 class="text-center py-3">My Hotels</h1>


    @foreach($hotels as $hotel)
    <div class="row">
        <div class="col-sm-8 mx-auto">

            <!-- List group-->
            <ul class="list-group" id="indexCard">

                <!-- list group item-->
                <li class="list-group-item">

                    <div class="my-2" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col">
                                <a href="{{ route('hotels.myHotelsShow', $hotel->id) }}"><img src="/storage/{{$hotel->image}} " class="img-responsive rounded-start" alt="Hotel Image" id="indexImage"></a>
                            </div>
                            <div class="col ms-3 pt-3">
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


                    <!-- End -->
                </li>
                <!-- End -->
            </ul>
        </div>
    </div>
    <br>
    @endforeach
    @endsection