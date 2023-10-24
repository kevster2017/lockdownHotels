@extends('layouts.app')

@section('content')


<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/contactUs') }}">Contact Us</a></li>
        <li>Contact Us Complete</li>
    </ul>
</div>

<div class="row">

    <!--Main Content-->
    <div class="container" style="background-color: rgb(212, 245, 223);">
        <div class="message-complete">
            <br>
            <h1>Your message has been sent</h1>
            <br>
            <p>Thank you for your message. We will be in touch as soon as possible.</p>
            <br>

            <a class="w-40 btn btn-success btn-md" type="btn btn-primary" href="{{ url('/') }}">Return to Home Page</a>
            <br><br>
        </div>
    </div>
</div>

@endsection