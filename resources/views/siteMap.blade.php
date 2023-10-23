@extends('layouts.app')

@section('content')

<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Site Map</li>
    </ul>
</div>


<!--Main container for background-->
<div class="bg">
    <div class="main-container">

        <!--Site Map Code-->
        <div class="container">
            <br>
            <h1>Site Map</h1>
            <hr>

            <div class="row">
                <div class="col-md-3 offset-md-3">
                    <ul class="booking">
                        <h3>Booking</h3>
                        <li class="page2">
                            <a href="BookingPage.html">Booking Page</a>
                        </li>
                        <li class="page3">
                            <a href="BookingReview.html">Booking Review</a>
                        </li>
                        <li class="page4">
                            <a href="PaymentPage.html">Payment Page</a>
                        </li>
                        <li class="page5">
                            <a href="PaymentComplete.html">Payment Complete</a>
                        </li>
                    </ul>
                </div>
                <br><br>

                <div class="col-md-3">
                    <ul class="listing">
                        <h3>List Property</h3>
                        <li class="page6">
                            <a href="ListYourProperty.html">List Your Property</a>
                        </li>
                        <li class="page7">
                            <a href="PropertyListingComplete.html">Property Listing Complete</a>
                        </li>
                    </ul>
                </div>
            </div>
            <br><br>

            <div class="row">
                <div class="col-md-3 offset-md-3">
                    <ul class="about">
                        <h3>About</h3>
                        <li class="page8">
                            <a href="{{ url('aboutUs') }}">About Us</a>
                        </li>
                    </ul>
                </div>

                <br><br>

                <div class="col-md-3">
                    <ul class="contact">
                        <h3>Contact</h3>
                        <li class="page9">
                            <a href="{{ url('contactUs') }}">Contact Us</a>
                        </li>
                        <li class="page10">
                            <a href="ContactUsComplete.html">Contact Us Complete</a>
                        </li>
                    </ul>
                </div>
            </div>
            <br><br>


            <div class="row">
                <div class="col-md-3 offset-md-3">

                    <ul class="siteMap">
                        <h3>Site Map</h3>
                        <li class="page11">
                            <a href="{{ url('siteMap') }}">Site Map</a>
                        </li>
                    </ul>
                </div>
                <br><br>



                <div class="col-md-3">
                    <ul class="terms">
                        <h3>Ts & Cs</h3>
                        <li class="page12">
                            <a href="{{ url('tsAndCs') }}">Terms and Conditions</a>
                        </li>
                    </ul>
                    <br><br>
                </div>

            </div>

            <div class="col-md-3 offset-md-3">
                <ul class="privacyPolicy">
                    <h3>Privacy</h3>
                    <li class="page13">
                        <a href="{{ url('privacyPolicy') }}">Privacy Policy</a>
                    </li>
                </ul>
                <br><br>


            </div>

            <!--Closing divs for background-->

        </div>
    </div>
    @endsection