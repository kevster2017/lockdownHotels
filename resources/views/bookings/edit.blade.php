@extends('layouts.app')

@section('content')


<!--Breadcrumb-->

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('myBookings') }}">My Bookings</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bookings.show', $booking->id) }}">{{ $booking->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit booking at {{ $booking->name }}</li>
        </ol>
    </nav>
</div>

<div class="container text-center">
    <h1 class="my-5">Edit your booking at {{ $booking->name }}</h1>
</div>
<!--Edit Booking form-->
<div class="container">
    <div class="message text-center">
        <form action="{{ route('contact.store') }}" method="POST" id="form" class="was-validated" onkeyup="manage()" novalidate>
            @csrf
            <br>
            <input type="hidden" name="userID" value="{{ Auth::user()->id }}">

            <div class="col-md-6 offset-md-3 text-left">
                <label for="nameInput" class="form-label">Name</label><br>
                <input type="text" class="form-control" id="nameInput" value="{{ auth()->user()->name }}" minlength="3" maxlength="40" name="name" required>
                <div class="invalid-feedback">Enter your name
                </div><br>
            </div>

            <div class="col-md-6 offset-md-3 text-left">
                <label for="emailInput" class="form-label">Email</label><br>
                <input type="email" class="form-control" id="emailInput" value="{{ auth()->user()->email }}" minlength="10" maxlength="50" name="email" required>
                <div class="invalid-feedback">Enter your email address
                </div><br>
            </div>


            <div class="col-md-6 offset-md-3 text-left">
                <label for="message" class="form-label">Message</label><br>
                <textarea id="message" class="form-control" id="messageInput" name="message" rows="6" columns="50" placeholder="500 characters max" minlength="5" maxlength="500" name="message" required>Booking ref: {{ $booking->id }}, I wish to request a change to my booking. I would like to change the following: (Please provide details here)</textarea>
                <div class="invalid-feedback">Enter your message
                </div><br>
            </div>
            <button id="send" class="btn btn-primary" type="submit">Submit</button>
        </form>

        <br><br>

    </div>

    <!--Social Media Icons-->
    <div class="container mt-5">
        <div class="social text-center">
            <h2>Follow Us</h2>

            <button data-toggle="tooltip" title="Click here to follow us on Instagram"><a href="https://www.instagram.com/" target="_blank"><img src="/images/Instagram.png" alt="Instagram button"></a></button>
            <button data-toggle="tooltip" title="Click here to follow us on YouTube"><a href="https://www.youtube.com/" target="_blank"><img src="/images/YouTube.png" alt="YouTube button"></a></button>
            <button data-toggle="tooltip" title="Click here to follow us on Facebook"><a href="https://www.facebook.com/" target="_blank"><img src="/images/Facebook.png" alt="Facebook button"></a></button>
            <button data-toggle="tooltip" title="Click here to follow us on Twitter"><a href="https://twitter.com/?lang=en-gb" target="_blank"><img src="/images/Twitter.png" alt="Twitter button"></a></button>
            <button data-toggle="tooltip" title="Click here to follow us on LinkedIn"><a href="https://uk.linkedin.com/" target="_blank"><img src="/images/LinkedIn.png" alt="LinkedIn button"></a></button>

        </div>
    </div>
    @endsection