@extends('layouts.app')

@section('content')
<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li>List Your Property</li>
    </ul>
</div>

<div class="container">
    <br>
    <h1>List Your Property</h1>
</div>


<!-- Form input -->
<form action="#" id="form" class="was-validated" onkeyup="manage()" novalidate>

    <br>

    <!--Property Name-->
    <div class="col-md-4 offset-md-4">
        <label for="PropertyName" class="form-label">Property Name</label>
        <div class="localStorage">
            <input type="text" class="form-control" id="propertyName" placeholder="Property Name" minlength="3" maxlength="40" onkeyup="createProperty()" required>
            <div class="invalid-feedback">Enter the name of your property</div><br>
        </div>
    </div>

    <!--Select Postcode-->
    <div class="col-md-4 offset-md-4">
        <label for="SelectPostcode" class="form-label">Enter Postcode</label>
        <input type="text" class="form-control" id="selectPostcode" placeholder="Postcode" minlength="6" maxlength="8" required>
        <div class="invalid-feedback">Enter the postcode of your property</div><br>
    </div>

    <!--Select Address-->
    <div class="col-md-4 offset-md-4">
        <label for="SelectAddress" class="form-label">Enter Address</label>
        <input type="text" class="form-control" id="selectAddress" placeholder="Address" minlength="6" maxlength="100" required>
        <div class="invalid-feedback">Enter the address of your property</div><br>
    </div>

    <!--Property Type-->
    <div class="Accomodation Type">
        <label for="AccomodationType" class="form-label">Accomodation Type</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="accomodationTypeOptions" id="hotel" value="hotel" onclick='checkBoxCheck("accomodationTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio1">Hotel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="accomodationTypeOptions" id="apartment" value="apartment" onclick='checkBoxCheck("accomodationTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio2">Apartment</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="accomodationTypeOptions" id="villa" value="villa" onclick='checkBoxCheck("accomodationTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio3">Villa</label>
        </div>
    </div>
    <br>

    <!--Room Type-->
    <div class="Room Type">
        <label for="RoomType" class="form-label">Room Type</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input room-type" type="radio" name="roomTypeOptions" id="single" value="single" onclick='checkBoxCheck("roomTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio4">Single</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input room-type" type="radio" name="roomTypeOptions" id="double" value="double" onclick='checkBoxCheck("roomTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio5">Double</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="roomTypeOptions" id="twin" value="twin" onclick='checkBoxCheck("roomTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio6">Twin</label>
        </div>
    </div>

    <br>

    <!--Currency Type-->
    <div class="currency">
        <label for="Currency" class="form-label">Currency</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="currencyOptions" id="sterling" value="sterling" onclick='checkBoxCheck("currencyOptions")' required>
            <label class="form-check-label" for="inlineRadio7">Sterling</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="currencyOptions" id="euro" value="euro" onclick='checkBoxCheck("currencyOptions")' required>
            <label class="form-check-label" for="inlineRadio8">Euro</label>
        </div>
    </div>

    <!--Price per night-->
    <label for="PricePerNight" class="form-label">Price Per Night</label>
    <div class="col-md-2 offset-md-5">
        <input type="text" class="form-control" id="single" placeholder="Room price per night" pattern="[0-9]+" minlength="2" maxlength="7" required>
        <div class="invalid-feedback">Enter the room price per night</div><br>
    </div>


    <!--Upload Photos-->
    <label for="addPhoto" class="form-label">Add Photos</label>
    <div class="input-group mb-3">
        <div class="col-md-4 offset-md-4">
            <input type="file" class="form-control" id="addPhoto" required>
            <div class="invalid-feedback">Upload at least one photo
            </div><br>
        </div>
    </div>

    <!--Description-->
    <div class="col-md-4 offset-md-4">
        <label for="messageInput" class="form-label">Description</label><br>
        <textarea class="form-control" id="messageInput" name="message" rows="6" columns="50" placeholder="500 characters max" minlength="1" maxlength="500" required></textarea>
        <div class="invalid-feedback">Enter your room description
        </div><br>
    </div>

    <!--Payment Options-->
    <label for="paymentOptions" class="form-label">Payment Options</label><br>
    <div class="form-check form-check-inline">

        <input class="form-check-input" type="checkbox" name="paymentOptions" id="creditCard" value="creditCard" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="creditCard">Credit Card</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="paymentOptions" id="debitCard" value="debitCard" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="debitCard">Debit Card</label>
    </div>
    <br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="paymentOptions" id="paypal" value="paypal" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="cash">PayPal</label>
    </div>
    <br><br>

    <!--Terms and Conditions-->
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="terms" id="terms" value="terms" onclick='checkBoxCheck("terms")' onchange="activateButton(this)" required>
        <label class="form-check-label" for="cash">I accept the terms and conditions</label>
    </div>

</form>
<br><br>

<!--List property button-->
<button id="listProperty" class="w-40 btn btn-success btn-md" type="submit" onclick="document.location='propertyListingComplete.html'" disabled="disabled">List Property</button>
<!--Script to enable List Property button after validating form-->
<script>
    function disableSubmit() {
        document.getElementById("listProperty").disabled = true;
    }

    function activateButton(element) {

        if (element.checked) {
            document.getElementById("listProperty").disabled = false;
        } else {
            document.getElementById("listProperty").disabled = true;
        }

    }
</script>

<!--Script to enable List Property button after validating form-->
<script>
    function manage(txt) {
        var bt = document.getElementById('listProperty');
        var ele = document.querySelectorAll('form')

        // Loop through each element.
        for (i = 0; i < ele.length; i++) {

            // Check the element type
            if (ele[0].checkValidity() == true && ele[1].checkValidity() == true &&
                ele[2].checkValidity() == true && ele[3].checkValidity() == true &&
                ele[4].checkValidity() == true && ele[5].checkValidity() == true &&
                ele[6].checkValidity() == true && ele[7].checkValidity() == true &&
                ele[8].checkValidity() == true && ele[9].checkValidity() == true &&
                ele[10].checkValidity() == true) {
                bt.disabled = false;
            } else {
                bt.disabled = true;
            }
        }
    }
</script>

<!--Script to check at least one radio/checkbox has been checked-->
<script>
    function checkBoxCheck(elemClass) {
        var elem = document.getElementsByName(elemClass);
        var oneBoxChecked = false;


        for (i = 0; i < elem.length; i++) {
            if (elem[i].checked === true) {
                oneBoxChecked = true;
            }
        }
        if (oneBoxChecked = true) {
            for (i = 0; i < elem.length; i++) {
                elem[i].required = false;
            }
        } else {
            for (i = 0; i < elem.length; i++) {
                elem[i].required = true;
            }
        }
    }
</script>
@endsection