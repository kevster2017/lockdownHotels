@extends('layouts.app')

@section('content')
<!--Script to enable Pay Now button after validating form-->
<script>
    function manage(txt) {
        var bt = document.getElementById('send');
        var ele = document.querySelectorAll('input, textarea');


        // Loop through each element.
        for (i = 0; i < ele.length; i++) {

            // Check the element type
            if (ele[0].checkValidity() == true && ele[1].checkValidity() == true &&
                ele[2].checkValidity() == true) {
                bt.disabled = false;
            } else {
                bt.disabled = true;
            }
        }
    }
</script>

<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Edit Booking</li>
    </ul>
</div>

<!--Contact Us Container-->
<br>
<div class="container">
    <div class="contact text-center">
        <br>
        <h1>Contact Us</h1><br>
        <p>If you would like to get in contact with us, feel free to get in touch using any of the methods
            below</p>

        <span>&#128222; Telephone: 02895 123456 (NI) / 442895 123456 (ROI) </span><br>
        <span>&#9993; Email: <a href="mailto:customerservice@lockdownhotels.com" target="_blank">customerservice@lockdownhotels.com</a></span><br>
        <span>&#9999; Write to us at the address below:<br>
            Lockdown Hotels <br>
            1a Main Street<br>
            Belfast<br>
            Co.Antrim<br>
            BT1 1LH<br><br>
        </span>
    </div>

</div>
<br><br>

<!--Contact Us form-->
<div class="container">
    <div class="message text-center">
        <form action="{{ route('contact.store') }}" method="POST" id="form" class="was-validated" onkeyup="manage()" novalidate>
            @csrf
            <br>
            <input type="hidden" name="userID" value="{{ Auth::user()->id }}">
            <p>Alternatively, you can send us a message and we will endeavour to reply as soon as possible
            </p>
            <div class="col-md-6 offset-md-3">
                <label for="nameInput" class="form-label">Name</label><br>
                <input type="text" class="form-control" id="nameInput" value="{{ auth()->user()->name }}" minlength="3" maxlength="40" name="name" required>
                <div class="invalid-feedback">Enter your name
                </div><br>
            </div>

            <div class="col-md-6 offset-md-3">
                <label for="emailInput" class="form-label">Email</label><br>
                <input type="email" class="form-control" id="emailInput" value="{{ auth()->user()->email }}" minlength="10" maxlength="50" name="email" required>
                <div class="invalid-feedback">Enter your email address
                </div><br>
            </div>

            <div class="col-md-6 offset-md-3">
                <label for="message" class="form-label">Message</label><br>
                <textarea id="message" class="form-control" id="messageInput" name="message" rows="6" columns="50" placeholder="500 characters max" minlength="5" maxlength="500" name="message" required></textarea>
                <div class="invalid-feedback">Enter your message
                </div><br>
            </div>
            <button id="send" class="btn btn-primary" type="submit" disabled="disabled">Submit</button>
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