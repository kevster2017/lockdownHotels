@extends('layouts.app')

@section('content')
<!--Breadcrumb-->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Your Property</li>
        </ol>
    </nav>
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

    <h1 class="text-center">List Your Property</h1>



    <!-- Form input -->
    <form method="POST" action="{{ route('hotels.store') }}" id="form" class="was-validated" onkeyup="manage()" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="hidden" name="userId" id="userId" value="{{ auth()->user() ->id }}" />


        <!--Property Name-->
        <div class="col-md-4 offset-md-4 mt-3">
            <label for="name" class="form-label">Property Name</label>
            <div class="localStorage">
                <input type="text" class="form-control" name="name" id="name" placeholder="Property Name" minlength="3" maxlength="40" onkeyup="createProperty()" value="{{ old('name') }}" required>
                <div class="invalid-feedback">Enter the name of your property</div><br>
            </div>
        </div>

        <!--Upload Photo-->
        <div class="col-md-4 offset-md-4">
            <label for="image" class="form-label text-center">Add Photo</label>
        </div>
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
            <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="address" placeholder="Address" minlength="6" maxlength="100" required>
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> @enderror
            <div class="invalid-feedback">Enter the address of your property</div><br>
        </div>

        <div class="col-md-4 offset-md-4">
            <label for="town" class="form-label">Enter Town</label>
            <input type="text" class="form-control" name="town" value="{{ old('town') }}" id="town" placeholder="Town" minlength="3" maxlength="100" required>
            @error('town')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> @enderror
            <div class="invalid-feedback">Enter Town</div><br>
        </div>

        <div class="col-md-4 offset-md-4">
            <label for="country" class="form-label">Enter Country</label>
            <input type="text" class="form-control" name="country" value="{{ old('country') }}" id="country" placeholder="Country" minlength="6" maxlength="100" required>
            @error('country')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> @enderror
            <div class="invalid-feedback">Enter Country</div><br>
        </div>

        <!--Select Postcode-->
        <div class="col-md-4 offset-md-4">
            <label for="postCode" class="form-label">Enter Postcode</label>
            <input type="text" class="form-control" name="postCode" value="{{ old('postCode') }}" id="postCode" placeholder="Postcode" minlength="6" maxlength="8" required>
            <div class="invalid-feedback">Enter the postcode of your property</div><br>
        </div>



        <!--Property Type-->
        <div class="col-md-4 offset-md-4">
            <div class="Accomodation Type">
                <label for="accomType" class="form-label">Accomodation Type</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="accomType" id="hotel" value="Hotel" onclick='checkBoxCheck("accomodationTypeOptions")' required>
                <label class="form-check-label" for="hotel">Hotel</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="accomType" id="apartment" value="Apartment" onclick='checkBoxCheck("accomodationTypeOptions")' required>
                <label class="form-check-label" for="apartment">Apartment</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="accomType" id="villa" value="Villa" onclick='checkBoxCheck("accomodationTypeOptions")' required>
                <label class="form-check-label" for="villa">Villa</label>
            </div>

        </div>
        <br>

        <!--Room Type-->

        <div class="col-md-4 offset-md-4">
            <label for="roomType" class="form-label">Room Type</label>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="Room Type">
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
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="roomType" id="family" value="Family" onclick='checkBoxCheck("roomTypeOptions")' required>
                    <label class="form-check-label" for="inlineRadio6">Family room</label>
                </div>
            </div>
        </div>

        <br>

        <!--Price per night-->
        <div class="col-md-4 offset-md-4">
            <label for="numRooms" class="form-label">Number of rooms</label>
        </div>
        <div class="col-md-2 offset-md-4">
            <input type="text" class="form-control" name="numRooms" id="numRooms" value="{{ old('numRooms') }}" placeholder="Number of rooms" pattern="[0-9]+" minlength="1" maxlength="3" required>
            <div class="invalid-feedback">Enter the number of rooms</div><br>
        </div>

        <br>

        <!--Price per night-->
        <div class="col-md-4 offset-md-4">
            <label for="holidayType" class="form-label">Select Holiday Type</label>
        </div>
        <div class="col-md-4 offset-md-4">

            <select class="form-select @error('holidayType') is-invalid @enderror" name="holidayType" id="holidayType" aria-label="Default select example" required>

                <option selected="City">City Break</option>
                <option value="Seaside">Seaside Resort</option>
                <option value="Country">Country Escape</option>

            </select> @error('holidayType')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> @enderror

        </div>

        <br>


        <!--Hotel Options-->
        <div class="container">
            <label for="hotelOptions" class="form-label">Hotel Options</label><br>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="feat1" class="form-label">Feature 1</label>
                    <input type="text" class="form-control" id="feat1" value="{{ old('feat1') }}" name="feat1" placeholder="E.g Add breakfast">
                </div>
                <div class="col-sm-4">
                    <label for="feat1Price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="feat1Price" name="feat1Price" value="{{ old('feat1Price') }}" placeholder="E.g 200">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="feat2" class="form-label">Feature 2</label>
                    <input type="text" class="form-control" id="feat2" value="{{ old('feat2') }}" name="feat2">
                </div>
                <div class="col-sm-4">
                    <label for="feat2Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="feat2Price" id="feat2Price" value="{{ old('feat2Price') }}" placeholder="E.g 200">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="feat3" class="form-label">Feature 3</label>
                    <input type="text" class="form-control" id="feat3" value="{{ old('feat3') }}" name="feat3">
                </div>
                <div class="col-sm-4">
                    <label for="feat3Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="feat3Price" id="feat3Price" value="{{ old('feat3Price') }}" placeholder="E.g 200">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="feat4" class="form-label">Feature 4</label>
                    <input type="text" class="form-control" id="feat4" value="{{ old('feat4') }}" name="feat4">
                </div>
                <div class="col-sm-4">
                    <label for="feat4Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="feat4Price" id="feat4Price" value="{{ old('feat4Price') }}" placeholder="E.g 200">
                </div>
            </div>


        </div>

        <div class="container">
            <label for="upgradeOptions" class="form-label">Upgrade Options</label><br>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="upgrade1" class="form-label">Upgrade 1</label>
                    <input type="text" class="form-control" id="upgrade1" value="{{ old('upgrade1') }}" name="upgrade1" placeholder="E.g Penthouse Suite">
                </div>
                <div class="col-sm-4">
                    <label for="upgrade1Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="upgrade1Price" id="upgrade1Price" value="{{ old('upgrade1Price') }}" placeholder="E.g 200">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="upgrade2" class="form-label">Upgrade 2</label>
                    <input type="text" class="form-control" id="upgrade2" value="{{ old('upgrade2') }}" name="upgrade2">
                </div>
                <div class="col-sm-4">
                    <label for="upgrade2Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="upgrade2Price" id="upgrade2Price" value="{{ old('upgrade2Price') }}" placeholder="E.g 200">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="upgrade3" class="form-label">Upgrade 3</label>
                    <input type="text" class="form-control" id="upgrade3" value="{{ old('upgrade3') }}" name="upgrade3">
                </div>
                <div class="col-sm-4">
                    <label for="upgrade3Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="upgrade3Price" id="upgrade3Price" value="{{ old('upgrade3Price') }}" placeholder="E.g 200">
                </div>
            </div>

        </div>


        <div class="container">
            <label for="packageOptions" class="form-label">Package Options</label><br>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="package1" class="form-label">Package 1</label>
                    <input type="text" class="form-control" id="package1" value="{{ old('package1') }}" name="package1" placeholder="E.g., Bridal Package">
                </div>
                <div class="col-sm-4">
                    <label for="package1Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="package1Price" id="package1Price" value="{{ old('package1Price') }}" placeholder="E.g 200">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="package2" class="form-label">Package 2</label>
                    <input type="text" class="form-control" id="package2" value="{{ old('package2') }}" name="package2">
                </div>
                <div class="col-sm-4">
                    <label for="package2Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="package2Price" id="package2Price" value="{{ old('package2Price') }}" placeholder="E.g 200">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="package3" class="form-label">Package 3</label>
                    <input type="text" class="form-control" id="package3" value="{{ old('package3') }}" name="package3">
                </div>
                <div class="col-sm-4">
                    <label for="package3Price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="package3Price" id="package3Price" value="{{ old('package3Price') }}" placeholder="E.g 200">
                </div>
            </div>

        </div>



        <!--Currency Type-->

        <div class="col-md-4 offset-md-4">
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
        <div class="col-md-4 offset-md-4">
            <label for="pricePerNight" class="form-label">Price Per Night</label>
        </div>
        <div class="col-md-4 offset-md-4">
            <input type="text" class="form-control" name="price" id="pricePerNight" placeholder="Room price per night" pattern="[0-9]+" minlength="2" maxlength="7" value="{{ old('price') }}" required>
            <div class="invalid-feedback">Enter the room price per night</div><br>
        </div>





        <!--Description-->
        <div class="col-md-4 offset-md-4">
            <label for="description" class="form-label">Description</label><br>
            <textarea class="form-control" id="description" name="description" rows="6" columns="50" placeholder="500 characters max" minlength="1" maxlength="500" required>{{ old('description') }}</textarea>
            <div class="invalid-feedback">Enter your room description
            </div><br>
        </div>



        <!--Terms and Conditions-->
        <div class="col-md-4 offset-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="agreeTerms" id="agreeTerms" value="{{ 1 }}" onclick='checkBoxCheck("terms")' onchange="activateButton(this)" required>
                <label class="form-check-label" for="agreeTerms">I accept the terms and conditions</label>
            </div>
        </div>
        <br>
        <!--List property button-->
        <div class="container text-center">
            <div class="form-check form-check-inline">
                <button id="listProperty" class="w-40 btn btn-success btn-md mt-3" type="submit" disabled="disabled">List Property</button>
            </div>
        </div>


    </form>

</div>
<!--Script to enable List Property button after validating form-->
<script>
    function disableSubmit() {
        document.getElementById("listProperty").disabled = true;
    }

    function activateButton(element) {

        document.getElementById("listProperty").disabled = !element.checked;

    }
</script>

<!--Script to enable List Property button after validating form-->
<script>
    function manage(txt) {
        var bt = document.getElementById('listProperty');
        var ele = document.querySelectorAll('form')

        // Loop through each element.
        var isValid = true;

        forms.forEach(function(form) {
            if (!form.checkValidity()) {
                isValid = false;
            }
        });

        bt.disabled = !isValid;
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
        if (oneBoxChecked == true) {
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