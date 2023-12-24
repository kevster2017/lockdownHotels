@extends('layouts.app')

@section('content')
<!--Breadcrumb-->

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('myHotels') }}">My Hotels</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hotel Details</li>
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
    <br>
    <h1 class="text-center">Edit Hotel Details</h1>
</div>

<div class="container">

    <div class="container my-5" id="hotelDetails">
        <!-- Form input -->
        <form method="POST" action="{{ route('hotels.update', $hotel->id) }}" id="form" class="was-validated" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <input type="hidden" name="userId" id="userId" value="{{ auth()->user() ->id }}" />

            <div class="row">
                <div class="col-sm-6">
                    <!--Property Name-->
                    <label for="name" class="form-label">Property Name</label>

                    <input type="text" class="form-control" name="name" id="name" placeholder="Property Name" minlength="3" maxlength="40" onkeyup="createProperty()" value="{{ old('name', $hotel->name) }}" required>
                    <div class="invalid-feedback">Enter the name of your property</div><br>

                    <!--Select Address-->
                    <label for="address" class="form-label">Enter Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $hotel->address) }}" id="address" placeholder="Address" minlength="6" maxlength="100" required>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span> @enderror
                    <div class="invalid-feedback">Enter the address of your property</div><br>

                    <!-- Enter Town -->
                    <label for="town" class="form-label">Enter Town</label>
                    <input type="text" class="form-control" name="town" value="{{ old('town', $hotel->town) }}" id="town" placeholder="Town" minlength="3" maxlength="100" required>
                    @error('town')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span> @enderror
                    <div class="invalid-feedback">Enter Town</div><br>

                    <!-- Enter Country-->
                    <label for="country" class="form-label">Enter Country</label>
                    <input type="text" class="form-control" name="country" value="{{ old('country', $hotel->country) }}" id="country" placeholder="Country" minlength="6" maxlength="100" required>
                    @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span> @enderror
                    <div class="invalid-feedback">Enter Country</div><br>

                    <!--Select Postcode-->
                    <label for="postCode" class="form-label">Enter Postcode</label>
                    <input type="text" class="form-control" name="postCode" value="{{ old('postCode', $hotel->postCode) }}" id="postCode" placeholder="Postcode" minlength="6" maxlength="8" required>
                    <div class="invalid-feedback">Enter the postcode of your property</div><br>

                </div> <!-- End Col 1 -->

                <div class="col-sm-6">
                    <!--Upload Photo-->
                    <label for="image" class="form-label text-center">Add Photo</label>
                    <div class="input-group">
                        <!-- Display old photo or current photo -->
                        @if ($hotel->image)
                        <img src="{{ asset('/storage/' . $hotel->image) }}" alt="Hotel Photo" class="img-thumbnail mb-2 me-1" style="max-width: 200px;">
                        @endif

                        <!-- Input for new photo -->
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span> @enderror
                        <div class="invalid-feedback">Upload hotel photo
                        </div>
                    </div>
                    <br>


                    <!--Price per night-->

                    <label for="pricePerNight" class="form-label">Price Per Night</label>
                    <input type="text" class="form-control" name="price" id="pricePerNight" placeholder="Room price per night" pattern="[0-9]+" minlength="2" maxlength="7" value="{{ old('price', $hotel->price) }}" required>
                    <div class="invalid-feedback">Enter the room price per night</div><br>


                    <!--Number of Rooms-->

                    <label for="numRooms" class="form-label">Number of rooms</label>

                    <input type="text" class="form-control" name="numRooms" id="numRooms" value="{{ old('numRooms', $hotel->numRooms) }}" placeholder="Number of rooms" pattern="[0-9]+" minlength="1" maxlength="3" required>
                    <div class="invalid-feedback">Enter the number of rooms</div><br>


                    <!-- Holiday Type -->
                    <label for="holidayType" class="form-label">Select Holiday Type</label>

                    <select class="form-select @error('holidayType') is-invalid @enderror" name="holidayType" id="holidayType" aria-label="Default select example" value="{{ old('holidayType', $hotel->holidayType) }}">

                        @if($hotel->holidayType == "City Break")
                        <option selected="City Break">{{ $hotel->holidayType}}</option>
                        <option value="Seaside Resort">Seaside Resort</option>
                        <option value="Country Escape">Country Escape</option>
                        @elseif($hotel->holidayType == "Seaside Resort")
                        <option selected="Seaside Resort">{{ $hotel->holidayType}}</option>
                        <option value="City Break">City Break</option>
                        <option value="Country Escape">Country Escape</option>
                        @else
                        <option selected="Country Escape">{{ $hotel->holidayType}}</option>
                        <option value="City Break">City Break</option>
                        <option value="Seaside Resort">Seaside Resort</option>

                        @endif
                    </select> @error('holidayType')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span> @enderror


                    <br>
                    <!-- Star Rating -->
                    <label for="stars" class="form-label">Select Star Rating</label>

                    <select class="form-select @error('stars') is-invalid @enderror" name="stars" id="stars" aria-label="Default select example" value="{{ old('stars', $hotel->stars) }}" required>

                        <option selected="{{ $hotel->stars }}">{{ $hotel->stars }}</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>

                    </select> @error('stars')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span> @enderror


                    <br>


                </div> <!-- End Col 2 -->
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <!--Room Type-->
                    <label for="roomType" class="form-label">Room Type</label>
                    <div class="Room Type mb-5">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input room-type" type="radio" name="roomType" id="single" value="Single" onclick='checkBoxCheck("roomTypeOptions")' {{ old('roomType', $hotel->roomType) == 'Single' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="single">Single</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="roomType" id="double" value="Double" onclick='checkBoxCheck("roomTypeOptions")' {{ old('roomType', $hotel->roomType) == 'Double' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="double">Double</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="roomType" id="twin" value="Twin" onclick='checkBoxCheck("roomTypeOptions")' {{ old('roomType', $hotel->roomType) == 'Twin' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="twin">Twin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="roomType" id="family" value="Family" onclick='checkBoxCheck("roomTypeOptions")' {{ old('roomType', $hotel->roomType) == 'Family' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="family">Family room</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!--Property Type-->
                    <div class="Accomodation Type">
                        <label for="accomType" class="form-label">Accomodation Type</label>
                    </div>

                    <div class="form-check form-check-inline mb-5">
                        <input class="form-check-input" type="radio" name="accomType" id="hotel" value="Hotel" onclick='checkBoxCheck("accomodationTypeOptions")' {{ old('accomType', $hotel->accomType) == 'Hotel' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="hotel">Hotel</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accomType" id="apartment" value="Apartment" {{ old('accomType', $hotel->accomType) == 'Apartment' ? 'checked' : '' }} onclick='checkBoxCheck("accomodationTypeOptions")' required>
                        <label class="form-check-label" for="apartment">Apartment</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accomType" id="villa" value="Villa" {{ old('accomType', $hotel->accomType) == 'Villa' ? 'checked' : '' }} onclick='checkBoxCheck("accomodationTypeOptions")' required>
                        <label class="form-check-label" for="villa">Villa</label>
                    </div>
                    <br>
                </div>
                <div class="col-sm-3">

                    <!--Currency Type-->
                    <div class="currency">
                        <label for="currency" class="form-label">Currency</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="currency" id="sterling" value="Sterling" onclick='checkBoxCheck("currencyOptions")' {{ old('currency', $hotel->currency) == 'Sterling' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="sterling">Sterling</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="currency" id="euro" value="Euro" onclick='checkBoxCheck("currencyOptions")' {{ old('currency', $hotel->currency) == 'Euro' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="euro">Euro</label>
                    </div><br>
                </div>
            </div>


            <!--Description-->
            <div class="col-sm-8 offset-md-2">
                <label for="description" class="form-label">Description</label><br>
                <textarea class="form-control" id="description" name="description" rows="6" columns="50" placeholder="500 characters max" minlength="1" maxlength="500" required>{{ old('description', $hotel->description) }}</textarea>
                <div class="invalid-feedback">Enter your room description
                </div><br>
            </div>

    </div>



    <!--Hotel Options-->
    <div class="container mt-5" id="featureOptions">
        <h5 for="hotelOptions" class="form-label">Hotel Options</h5><br>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="feat1" class="form-label">Feature 1</label>
                <input type="text" class="form-control" id="feat1" value="{{ old('feat1', $hotel->feat1) }}" name="feat1" placeholder="E.g Add breakfast">
            </div>
            <div class="col-sm-4">
                <label for="feat1Price" class="form-label">Price</label>
                <input type="text" class="form-control" id="feat1Price" name="feat1Price" value="{{ old('feat1Price', $hotel->feat1Price) }}" placeholder="E.g 200">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="feat2" class="form-label">Feature 2</label>
                <input type="text" class="form-control" id="feat2" value="{{ old('feat2', $hotel->feat2) }}" name="feat2">
            </div>
            <div class="col-sm-4">
                <label for="feat2Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="feat2Price" id="feat2Price" value="{{ old('feat2Price', $hotel->feat2Price) }}" placeholder="E.g 200">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="feat3" class="form-label">Feature 3</label>
                <input type="text" class="form-control" id="feat3" value="{{ old('feat3', $hotel->feat3) }}" name="feat3">
            </div>
            <div class="col-sm-4">
                <label for="feat3Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="feat3Price" id="feat3Price" value="{{ old('feat3Price', $hotel->feat3Price) }}" placeholder="E.g 200">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="feat4" class="form-label">Feature 4</label>
                <input type="text" class="form-control" id="feat4" value="{{ old('feat4', $hotel->feat4) }}" name="feat4">
            </div>
            <div class="col-sm-4">
                <label for="feat4Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="feat4Price" id="feat4Price" value="{{ old('feat4Price', $hotel->feat4Price) }}" placeholder="E.g 200">
            </div>
        </div>


    </div>

    <div class="container mt-3" id="upgradeOptions">
        <h5 for="upgradeOptions" class="form-label">Upgrade Options</h5><br>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="upgrade1" class="form-label">Upgrade 1</label>
                <input type="text" class="form-control" id="upgrade1" value="{{ old('upgrade1', $hotel->upgrade1) }}" name="upgrade1" placeholder="E.g Penthouse Suite">
            </div>
            <div class="col-sm-4">
                <label for="upgrade1Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="upgrade1Price" id="upgrade1Price" value="{{ old('upgrade1Price', $hotel->upgrade1Price) }}" placeholder="E.g 200">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="upgrade2" class="form-label">Upgrade 2</label>
                <input type="text" class="form-control" id="upgrade2" value="{{ old('upgrade2', $hotel->upgrade2) }}" name="upgrade2">
            </div>
            <div class="col-sm-4">
                <label for="upgrade2Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="upgrade2Price" id="upgrade2Price" value="{{ old('upgrade2Price', $hotel->upgrade2Price) }}" placeholder="E.g 200">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="upgrade3" class="form-label">Upgrade 3</label>
                <input type="text" class="form-control" id="upgrade3" value="{{ old('upgrade3', $hotel->upgrade3) }}" name="upgrade3">
            </div>
            <div class="col-sm-4">
                <label for="upgrade3Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="upgrade3Price" id="upgrade3Price" value="{{ old('upgrade3Price', $hotel->upgrade3Price) }}" placeholder="E.g 200">
            </div>
        </div>

    </div>


    <div class="container mt-3" id="packageOptions">
        <h5 for="packageOptions" class="form-label">Package Options</h5><br>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="package1" class="form-label">Package 1</label>
                <input type="text" class="form-control" id="package1" value="{{ old('package1', $hotel->package1) }}" name="package1" placeholder="E.g., Bridal Package">
            </div>
            <div class="col-sm-4">
                <label for="package1Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="package1Price" id="package1Price" value="{{ old('package1Price', $hotel->package1Price) }}" placeholder="E.g 200">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="package2" class="form-label">Package 2</label>
                <input type="text" class="form-control" id="package2" value="{{ old('package2', $hotel->package2) }}" name="package2">
            </div>
            <div class="col-sm-4">
                <label for="package2Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="package2Price" id="package2Price" value="{{ old('package2Price', $hotel->package2Price) }}" placeholder="E.g 200">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-8">
                <label for="package3" class="form-label">Package 3</label>
                <input type="text" class="form-control" id="package3" value="{{ old('package3', $hotel->package3) }}" name="package3">
            </div>
            <div class="col-sm-4">
                <label for="package3Price" class="form-label">Price</label>
                <input type="text" class="form-control" name="package3Price" id="package3Price" value="{{ old('package3Price', $hotel->package3Price) }}" placeholder="E.g 200">
            </div>
        </div>

    </div>




    <!--Terms and Conditions-->
    <div class="col-md-4 offset-md-4 text-center mt-5">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="agreeTerms" id="agreeTerms" value="{{ 1 }}" onclick='checkBoxCheck("terms")' onchange="activateButton(this)" required>
            <label class="form-check-label" for="agreeTerms">I accept the terms and conditions</label>
        </div>
    </div>
    <br>
    <!--List property button-->
    <div class="container text-center">
        <div class="form-check form-check-inline">
            <button id="listProperty" class="w-40 btn btn-success btn-md mt-3" type="submit" disabled="disabled">Edit Property</button>
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