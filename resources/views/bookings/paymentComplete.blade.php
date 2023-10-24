@extends('layouts.app')

@section('content')
<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ route('bookings.create') }}">Booking Page</a></li>
        <li><a href="{{ route('bookings.payment') }}">Payment</a></li>
        <li>Payment Complete</li>
    </ul>
</div>

<div class="row">

    <!--Main Content-->
    <div class="container" style="background-color: rgb(212, 245, 223);">
        <div class="payment-complete">
            <br>
            <h1>Your payment is now complete</h1>
            <h3>Booking reference number is - 445879</h3>
            <br>
            <p>We hope you enjoy your stay at <b><span id="result"></span></b></p>
            <script>
                document.getElementById("result").innerHTML = localStorage.getItem("hotel");
            </script>
            <p>Thank you for shopping with Lockdown Hotels</p>
            <br>
            <p>Treat yourself to another holiday?</p><br>
            <a class="w-40 btn btn-success btn-md" type="btn btn-primary" href="{{ route('bookings.create') }}">Yes
                please!!!</a>
            <br><br>
        </div>
    </div>


</div>
@endsection