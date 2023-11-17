@extends('layouts.app')

@section('content')

<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>BookingReview</li>
    </ul>
</div>

<div class="container">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">

                <!--
                <img src="/storage/{{ $cart->image }}" class="img-fluid rounded-start" alt="Hotel Image">
-->

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $cart->name }}</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                    <p class="card-text"><small class="text-body-secondary">Added to Cart: {{ $cart->created_at }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection