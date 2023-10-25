@extends('layouts.app')

@section('content')
<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li>List Your Property</li>
    </ul>
</div>

@if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <br>
    <h1>List Your Property</h1>
</div>


<!-- Form input -->
<form method="POST" action="{{ route('hotels.store') }}" id="form" class="was-validated" onkeyup="manage()" enctype="multipart/form-data" novalidate>
    @csrf
    <input type="hidden" name="userId" id="userId" value="{{ 1 }}" />


    <!--Property Name-->
    <div class="col-md-4 offset-md-4 mt-3">
        <label for="PropertyName" class="form-label">Property Name</label>
        <div class="localStorage">
            <input type="text" class="form-control" name="name" id="name" placeholder="Property Name" minlength="3" maxlength="40" onkeyup="createProperty()" required>
            <div class="invalid-feedback">Enter the name of your property</div><br>
        </div>
    </div>

    <!--Upload Photo-->
    <label for="image" class="form-label">Add Photo</label>
    <div class="input-group mb-3">
        <div class="col-md-4 offset-md-4">
            <input type="file" class="form-control" name="image" id="image" required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> @enderror
            <div class="invalid-feedback">Upload hotel photo
            </div><br>
        </div>
    </div>

    <!--Select Address-->
    <div class="col-md-4 offset-md-4">
        <label for="address" class="form-label">Enter Address</label>
        <input type="text" class="form-control" name="address" id="address" placeholder="Address" minlength="6" maxlength="100" required>
        @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span> @enderror
        <div class="invalid-feedback">Enter the address of your property</div><br>
    </div>

    <div class="col-md-4 offset-md-4">
        <label for="town" class="form-label">Enter Town</label>
        <input type="text" class="form-control" name="town" id="town" placeholder="Town" minlength="3" maxlength="100" required>
        @error('town')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span> @enderror
        <div class="invalid-feedback">Enter Town</div><br>
    </div>

    <div class="col-md-4 offset-md-4">
        <label for="country" class="form-label">Enter Country</label>
        <input type="text" class="form-control" name="country" id="country" placeholder="Country" minlength="6" maxlength="100" required>
        @error('country')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span> @enderror
        <div class="invalid-feedback">Enter Country</div><br>
    </div>

    <!--Select Postcode-->
    <div class="col-md-4 offset-md-4">
        <label for="postcode" class="form-label">Enter Postcode</label>
        <input type="text" class="form-control" name="postCode" id="postCode" placeholder="Postcode" minlength="6" maxlength="8" required>
        <div class="invalid-feedback">Enter the postcode of your property</div><br>
    </div>



    <!--Property Type-->
    <div class="Accomodation Type">
        <label for="accomType" class="form-label">Accomodation Type</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="accomType" id="hotel" value="Hotel" onclick='checkBoxCheck("accomodationTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio1">Hotel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="accomType" id="apartment" value="Apartment" onclick='checkBoxCheck("accomodationTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio2">Apartment</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="accomType" id="villa" value="Villa" onclick='checkBoxCheck("accomodationTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio3">Villa</label>
        </div>
    </div>
    <br>

    <!--Room Type-->
    <div class="Room Type">
        <label for="roomType" class="form-label">Room Type</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input room-type" type="radio" name="roomType" id="single" value="Single" onclick='checkBoxCheck("roomTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio4">Single</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input room-type" type="radio" name="roomType" id="double" value="Double" onclick='checkBoxCheck("roomTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio5">Double</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="roomType" id="twin" value="Twin" onclick='checkBoxCheck("roomTypeOptions")' required>
            <label class="form-check-label" for="inlineRadio6">Twin</label>
        </div>
    </div>

    <br>

    <!--Price per night-->
    <label for="numRooms" class="form-label">Number of rooms</label>
    <div class="col-md-2 offset-md-5">
        <input type="text" class="form-control" name="numRooms" id="numRooms" placeholder="Number of rooms" pattern="[0-9]+" minlength="1" maxlength="3" required>
        <div class="invalid-feedback">Enter the number of rooms</div><br>
    </div>

    <br>

    <!--Price per night-->
    <label for="holidayType" class="form-label">Select Holiday Type</label>
    <div class="col-md-2 offset-md-5">
        <div class="col">
            <select class="form-select @error('holidayType') is-invalid @enderror" name="holidayType" aria-label="Default select example" required>

                <option selected="City">City Break</option>
                <option value="Seaside">Seaside Resort</option>
                <option value="Country">Country Escape</option>

            </select> @error('holidayType')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> @enderror
        </div>
    </div>

    <br>


    <!--Payment Options-->
    <label for="hotelOptions" class="form-label">Hotel Options</label><br>
    <div class="form-check form-check-inline">

        <input class="form-check-input" type="checkbox" name="hotelOptions" id="bAndB" value="Bed and Breakfast" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="bAndB">Breakfast</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="hotelOptions" id="threeCourse" value="Three Course Dinner" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="threeCourse">Three Course Meal</label>
    </div>
    <br>
    <div class="form-check form-check-inline mb-3">
        <input class="form-check-input" type="checkbox" name="hotelOptions" id="spa" value="Spa" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="spa">Spa Break</label>
    </div>



    <!--Currency Type-->
    <div class="currency mb-3">
        <label for="Currency" class="form-label">Currency</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="currency" id="sterling" value="Sterling" onclick='checkBoxCheck("currencyOptions")' required>
            <label class="form-check-label" for="inlineRadio7">Sterling</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="currency" id="euro" value="Euro" onclick='checkBoxCheck("currencyOptions")' required>
            <label class="form-check-label" for="inlineRadio8">Euro</label>
        </div>
    </div>

    <!--Price per night-->
    <label for="PricePerNight" class="form-label">Price Per Night</label>
    <div class="col-md-2 offset-md-5">
        <input type="text" class="form-control" name="price" id="price" placeholder="Room price per night" pattern="[0-9]+" minlength="2" maxlength="7" required>
        <div class="invalid-feedback">Enter the room price per night</div><br>
    </div>




    <!--Description-->
    <div class="col-md-4 offset-md-4">
        <label for="description" class="form-label">Description</label><br>
        <textarea class="form-control" id="description" name="description" rows="6" columns="50" placeholder="500 characters max" minlength="1" maxlength="500" required></textarea>
        <div class="invalid-feedback">Enter your room description
        </div><br>
    </div>

    <!--Payment Options-->
    <label for="paymentOptions" class="form-label">Payment Options</label><br>
    <div class="form-check form-check-inline">

        <input class="form-check-input" type="checkbox" name="payOpts" id="creditCard" value="Credit Card" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="creditCard">Credit Card</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="payOpts" id="debitCard" value="Debit Card" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="debitCard">Debit Card</label>
    </div>
    <br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="payOpts" id="paypal" value="Paypal" onclick='checkBoxCheck("paymentOptions")' required>
        <label class="form-check-label" for="cash">PayPal</label>
    </div>
    <br><br>

    <!--Terms and Conditions-->
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="agreeTerms" id="agreeTerms" value="{{ 1 }}" onclick='checkBoxCheck("terms")' onchange="activateButton(this)" required>
        <label class="form-check-label" for="cash">I accept the terms and conditions</label>
    </div>

    <br>
    <!--List property button-->
    <div class="form-check form-check-inline">
        <button id="listProperty" class="w-40 btn btn-success btn-md mt-3" type="submit" disabled="disabled">List Property</button>
    </div>

</form>


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