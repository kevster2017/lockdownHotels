@extends('layouts.app')

@section('content')

<script>
    window.addEventListener("load", function() {
        // (C2) POPUP DATE PICKER
        picker.attach({
            target: "checkInDate",
            container: "pick-inline"
        });

        // Checking if a hotel type has been selected from the booking page.
        checkPreselectedHotelType();
    });
</script>

<script>
    // This function populates the dropdown with the loctions based on the hotel type selected.
    function selectHotelType(hotelType) {
        clearLocationDropdown();
        resetNoOfNights();
        document.getElementById('checkInDate').value = null;

        $("#hotelFeaturesSection").slideUp("slow");
        $("#holidayTypeSelectionSection").slideUp("slow");
        $("#holidayTypesSection").slideUp("slow");
        $("#roomUpgradeSection").slideUp("slow");
        $("#priceSummarySection").slideUp("slow");

        document.getElementById('noLocationSelectedErrorMessage').style.display = "none";
        document.getElementById('noCheckInDateEnteredErrorMessage').style.display = "none";

        $("#locationSelectionSection").slideDown("slow");

        // Creating a blank option in location drop down box.
        createLocationOption(document.getElementById('locationDropdown'), "", null);

        if (hotelType == "cityBreak") {
            document.getElementById('cityBreak').style.backgroundColor = 'white';
            document.getElementById('seasideResort').style.backgroundColor = '#004aad';
            document.getElementById('countryEscape').style.backgroundColor = '#004aad';

            document.getElementById('cityBreak').style.color = '#004aad';
            document.getElementById('seasideResort').style.color = 'white';
            document.getElementById('countryEscape').style.color = 'white';

            for (i = 0; i < 3; i++) {
                createLocationOption(document.getElementById('locationDropdown'), hotels[i].location, hotels[i].location);
            }
        } else if (hotelType == "seasideResort") {
            document.getElementById('cityBreak').style.backgroundColor = '#004aad';
            document.getElementById('seasideResort').style.backgroundColor = 'white';
            document.getElementById('countryEscape').style.backgroundColor = '#004aad';
            document.getElementById('cityBreak').style.color = 'white';
            document.getElementById('seasideResort').style.color = '#004aad';
            document.getElementById('countryEscape').style.color = 'white';
            for (i = 3; i < 6; i++) {
                createLocationOption(document.getElementById('locationDropdown'), hotels[i].location, hotels[i].location);
            }
        } else {
            console.log(hotelType);
            document.getElementById('cityBreak').style.backgroundColor = '#004aad';
            document.getElementById('seasideResort').style.backgroundColor = '#004aad';
            document.getElementById('countryEscape').style.backgroundColor = 'white';
            document.getElementById('cityBreak').style.color = 'white';
            document.getElementById('seasideResort').style.color = 'white';
            document.getElementById('countryEscape').style.color = '#004aad';
            for (i = 6; i < 9; i++) {
                createLocationOption(document.getElementById('locationDropdown'), hotels[i].location, hotels[i].location);
            }
        }
        document.getElementById('locationDropdown').options.checked = null;
    }
</script>

<script>
    function checkPreselectedHotelType() {
        var preselectedHotelType = localStorage.getItem("preselectedHotelType");

        if (preselectedHotelType != "null") {
            selectHotelType(preselectedHotelType);
            localStorage.setItem("preselectedHotelType", "null");
        }
    }

    function clearLocationDropdown() {
        for (i = document.getElementById('locationDropdown').options.length - 1; i >= 0; i--) {
            document.getElementById('locationDropdown').options[i] = null;
        }
    }

    function resetNoOfNights() {
        document.getElementById('noOfNightsRange').value = 1;
        document.getElementById('noOfNightsRangeLabel').innerHTML = "No. of Nights: 1";
        noOfNights = 1;
    }

    function createLocationOption(element, text, value) {
        var option = document.createElement('option');
        option.text = text;
        option.value = value;
        element.options.add(option);
    }

    function hasLocationBeenSelected() {
        if (document.getElementById('locationDropdown').value == "null") {
            return false;
        } else {
            return true;
        }
    }

    // Open and Close Date Picker Model
    function openModal() {
        document.getElementById("checkInDateModalBackdrop").style.display = "block";
        document.getElementById("staticBackdrop").style.display = "block";
        document.getElementById("staticBackdrop").className += "show";
    }

    function closeModal() {
        document.getElementById("checkInDateModalBackdrop").style.display = "none"
        document.getElementById("staticBackdrop").style.display = "none"
        document.getElementById("staticBackdrop").className += document.getElementById("staticBackdrop").className.replace("show", "")
    }

    // Update number of nights
    function updateNoOfNights(value) {
        document.getElementById('noOfNightsRangeLabel').innerHTML = "No. of Nights: " + value;
        noOfNights = value;
        var valid = true;

        if (!hasLocationBeenSelected()) {
            document.getElementById('noLocationSelectedErrorMessage').style.display = "block";
            valid = false;
        }
        if (!hasCheckInDateBeenSelected()) {
            document.getElementById('noCheckInDateEnteredErrorMessage').style.display = "block";
            valid = false;
        }

        if (customHoliday) {
            if (getSelectedRoomType() != null) {
                if (selectedRoomUpgrade == null) {
                    updateRoomPriceSummary(getSelectedRoomType());
                } else {
                    updateRoomUpgradePriceSummary();
                }
            }
        } else {
            if (selectedPackage != null) {
                updatePackagePriceSummary();
            }
        }
    }

    // Has checkin date been selected
    function hasCheckInDateBeenSelected() {
        if (document.getElementById('checkInDate').value == "") {
            return false;
        } else {
            return true;
        }
    }
</script>




<!--Hotel types section-->
<div class="container-fluid">
    <div class="container">

        <div class="row">
            <h2 style="color:#737373; text-align: left; padding-top: 10px; padding-bottom: 5px;">Select your holiday type...</h2>
        </div>

        <div class="row" style="text-align: right;">
            <div class="card-group" style="align-self: center;">

                <div class="card" style="border:none; margin-right: 30px;">
                    <img src="/images/booking-page/cityBreak.png" width=100% height=100%>
                    <div class="card-body" style="align-self: center;">
                        <button class="btn btn-primary holiday-type" onclick="selectHotelType(id)" id="cityBreak" style="margin-top: 0; border-radius: 10px; width: 190px; height: 45px; background-color: #004aad; font-weight: bold; font-size: 110%;">City Break</button>
                    </div>
                </div>

                <div class="card" style="border:none; margin-right: 30px;">
                    <img src="/images/booking-page/seasideResort.png" width=100% height=100%>
                    <div class="card-body" style="align-self: center;">
                        <button class="btn btn-primary holiday-type" onclick="selectHotelType(id)" id="seasideResort" style="margin-top: 0; border-radius: 10px; width: 190px; height: 45px; background-color: #004aad; font-weight: bold; font-size: 110%;">Seaside Resort</button>
                    </div>
                </div>

                <div class="card" style="border:none;">
                    <img src="/images/booking-page/countryEscape.png" width=100% height=100%>
                    <div class="card-body" style="align-self: center;">
                        <button class="btn btn-primary holiday-type" onclick="selectHotelType(id)" id="countryEscape" style="margin-top: 0; border-radius: 10px; width: 190px; height: 45px; background-color: #004aad; font-weight: bold; font-size: 110%;">Country Escape</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!--Modal for displaying the calendar picker for the check in date-->
<form method="POST" action="{{ route('bookings.store') }}">
    @csrf


    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: bold;">Check In Date:</h5>
                    <button type="button" class="btn-close" onClick="closeModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="checkInDateModalBody">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" id="checkInDateModalBackdrop" style="display: none"></div>

    <!--Location selection section-->
    <!--Includes the check in date and no. of nights fields-->
    <div class="container-fluid" id="locationSelectionSection" style="padding-top: 10px; background-image: linear-gradient(to right, #B3B3B3, #737373, #B3B3B3); align-self: center; display: none;  padding-bottom: 15px;">
        <div class="container">
            <form class="row g-3" style="color: white;">

                <div class="col" style="text-align: left;">

                    <label class="form-label" for="locationDropdown" style="font-weight: bold">Location:</label>
                    <select class="form-select" id="locationDropdown" onchange="selectLocation(value)" aria-label="Select location" style="margin-top: 0px; vertical-align: top;">

                    </select>

                    <div id="noLocationSelectedErrorMessage" style="color: rgb(161, 15, 15); padding-top: 10px; display: none;">
                        * Please select a location.
                    </div>

                </div>

                <div class="col" style="text-align: left;">

                    <label style="font-weight: bold; padding-bottom: 8px;">Check In:</label>
                    <input type="text" class="form-control" id="checkInDate" placeholder="dd/mm/yyyy" style=" background-color: white !important;" onclick="openModal()" readonly>

                    <div id="noCheckInDateEnteredErrorMessage" style="color: rgb(161, 15, 15); padding-top: 10px; display: none;">
                        * Please select a check in date.
                    </div>

                </div>

                <div class="col" style="text-align: left;">

                    <label class="align-left" id="noOfNightsRangeLabel" style="font-weight: bold; padding-bottom: 15px;">No. of Nights: 1</label>
                    <input type="range" onchange="updateNoOfNights(value)" class="form-range" id="noOfNightsRange" min="1" max="30" step="1" value="1">

                </div>

            </form>
        </div>
    </div>

    <!--Hotel features section-->
    <div class="container-fluid" id="hotelFeaturesSection" style="padding-top: 10px; background-color: white; align-self: center; display: none">

        <div class="container">
            <div class="row" style="padding-top: 10px;">

                <div class="col">
                    <h3 style="text-align: left; color:#737373">What this hotel has to offer...</h2>
                </div>

                <div class="col">
                    <h3 id="hotelName" style="text-align: right; color:#bc9c22">
                        </h2>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row" style="align-content: center; padding-top: 10px; padding-bottom: 10px; color: white;">

                <div class="container" style="width: 14rem; height: 100%; border: none; position: relative; padding: 0px; padding-bottom: 20px;">
                    <img id="hotelFeature1Image" width=100% height=100%>
                    <div id="hotelFeature1Text" style="text-align: center; background: rgba(0,0,0,0.6); position: absolute; bottom: 20px; padding: 15px; width: 100%; font-size: 115%; font-weight: bold"></div>
                </div>

                <div class="container" style="width: 14rem; height: 100%; border:none; position: relative; padding: 0px; padding-bottom: 20px;">
                    <img id="hotelFeature2Image" width=100% height=100%>
                    <div id="hotelFeature2Text" style="text-align: center; background: rgba(0,0,0,0.6); position: absolute; bottom: 20px; padding: 15px; width:100%; font-size: 115%; font-weight: bold"></div>
                </div>

                <div class="container" style="width: 14rem; height: 100%; border:none; position: relative; padding: 0px; padding-bottom: 20px;">
                    <img id="hotelFeature3Image" width=100% height=100%>
                    <div id="hotelFeature3Text" style="text-align: center; background: rgba(0,0,0,0.6); position: absolute; bottom: 20px; padding: 15px; width:100%; font-size: 115%; font-weight: bold"></div>
                </div>

                <div class="container" style="width: 14rem; height: 100%; border:none; position: relative; padding: 0px; padding-bottom: 20px;">
                    <img id="hotelFeature4Image" width=100% height=100%>
                    <div id="hotelFeature4Text" style="text-align: center; background: rgba(0,0,0,0.6); position: absolute; bottom: 20px; padding: 15px; width:100%; font-size: 115%; font-weight: bold"></div>
                </div>

            </div>
        </div>

    </div>


    <!--Holiday type selection section-->
    <div class="container-fluid" id="holidayTypeSelectionSection" style="background-image: linear-gradient(to right, #B3B3B3, #737373, #B3B3B3); align-self: center; padding-top: 8px; display: none">
        <div class="container">
            <div class="row" style="align-content: flex-end;">

                <div class="col">
                    <h2 id="headingOne">
                        <button id="customHolidayButton" class="btn" type="button" onclick="displayCustomHolidayForm()" style="background-color: none; color: white; border-color: white; border-radius: 0%; border-width: 2px; font-size: 25px;">
                            Custom
                        </button>
                    </h2>
                </div>

                <div class="col">
                    <h2 id="headingTwo">
                        <button id="packageHolidayButton" class="btn" type="button" onclick="displayPackageHolidayForm()" style="background-color: none; color: white; border-color: white; border-radius: 0%; border-width: 0px; font-size: 25px;">
                            Package
                        </button>
                    </h2>
                </div>

            </div>
        </div>
    </div>

    <!--Holiday types section-->
    <div class="container-fluid" id="holidayTypesSection" style="padding-top: 20px; padding-bottom: 20px; background-image: linear-gradient(#CBB252, #D2BD6C); align-self: center; display: none;">
        <div class="container">

            <!--Custom holiday section-->
            <div id="customHolidaySection">

                <div class="row" style="color: white;">
                    <div class="col">
                        <div class="row">

                            <div class="col" style="text-align: right;">
                                <label><b>Room Type:</b></label>
                            </div>

                            <div class="col">

                                <div class="form-check" style="text-align: left;">
                                    <input class="form-check-input" id="roomTypeRadio1" type="radio" name="roomtypeRadios" onclick="updateRoomPriceSummary(value)" value="Single">
                                    <label class="form-check-label">Single</label>
                                </div>

                                <div class="form-check" style="text-align: left;">
                                    <input class="form-check-input" id="roomTypeRadio2" type="radio" name="roomtypeRadios" onclick="updateRoomPriceSummary(value)" value="Double">
                                    <label class="form-check-label">Double</label>
                                </div>

                                <div class="form-check" style="text-align: left;">
                                    <input class="form-check-input" id="roomTypeRadio3" type="radio" name="roomtypeRadios" onclick="updateRoomPriceSummary(value)" value="Twin">
                                    <label class="form-check-label">Twin</label>
                                </div>

                                <div class="form-check" style="text-align: left;">
                                    <input class="form-check-input" id="roomTypeRadio4" type="radio" name="roomtypeRadios" onclick="updateRoomPriceSummary(value)" value="Family">
                                    <label class="form-check-label">Family</label>
                                </div>

                            </div>

                            <div id="noRoomTypeSelectedErrorMessage" style="color: rgb(161, 15, 15); display: none;">
                                * Please select a room type.
                            </div>

                        </div>
                    </div>

                    <div class="col">
                        <div class="row">

                            <div class="col" style="text-align: right;">
                                <label><b>Extras:</b></label>
                            </div>

                            <div id="extrasCheckbox" class="col">

                                <div class="form-check" style="text-align: left;">
                                    <input class="form-check-input" onclick="updateExtrasPriceSummary()" name="Breakfast" type="checkbox" value="25" id="extrasCheckbox1">
                                    <label class="form-check-label">Breakfast</label>
                                </div>

                                <div class="form-check" style="text-align: left;">
                                    <input class="form-check-input" onclick="updateExtrasPriceSummary()" name="3 Course Evening Meal" type="checkbox" value="35" id="extrasCheckbox2">
                                    <label class="form-check-label">3 Course Evening Meal</label>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="container" id="roomUpgradeSection" style="display: none; padding-bottom: 10px; padding-top: 10px;">
                    <div class="row" style="background-image: linear-gradient(#598433, #6f944e); align-self: center; margin-top: 10px; margin-left: 30px; margin-right: 30px;">

                        <span style="border-radius: 0px; width: 160px; height: 40px; background-color: #004aad; color: white; font-weight: bold; position: relative; top: 0; left: 0; padding-top: 8px">Room Upgrade</span>

                        <div class="container" style="padding-top: 30px; padding-left: 30px; padding-right: 30px; padding-bottom: 30px;">
                            <div class="row">

                                <div class="card-group" style="align-self: center;">

                                    <div class="card roomUpgrade" id="juniorSuite" onclick="selectRoomUpgrade(id)" style="border: none; border-radius: 0%; margin-right: 20px;">

                                        <img src="/images/booking-page/juniorSuite.png">

                                        <div class="card-body" style="background-color: #B3B3B3; text-align: left; padding: 15px">
                                            <h4 class="card-title" style="color: white; font-weight: bold">Junior Suite</h4>
                                            <p style="color: white;">Upgrade your holiday our Junior suite. With a queen sized bed, this room has more space than our standard double room. </p>
                                            <h5 id="roomUpgrade1Price" style="color: white; text-align: right; font-style: italic;"></h5>
                                        </div>

                                        <span><img id="juniorSuiteImage" src="/images/booking-page/plusSign.png" width=40%></span>

                                    </div>

                                    <div class="card roomUpgrade" id="bridalSuite" onclick="selectRoomUpgrade(id)" style="border:none; border-radius: 0%; margin-right: 20px;">

                                        <img src="/images/booking-page/bridalSuite.png">

                                        <div class="card-body" style="background-color: #B3B3B3; text-align: left; padding: 15px">
                                            <h4 class="card-title" style="color: white; font-weight: bold">Bridal Suite</h4>
                                            <p style="color: white;">This room comes with a king sized bed and our signiture bridal pack including slippers and bathrobes. Ensuite includes a jacuzzi bath to help you de-stress.</p>
                                            <h5 id="roomUpgrade2Price" style="color: white; text-align: right; font-style: italic;"></h5>
                                        </div>

                                        <span><img id="bridalSuiteImage" src="/images/booking-page/plusSign.png" width=40%></span>

                                    </div>

                                    <div class="card roomUpgrade" id="penthouseSuite" onclick="selectRoomUpgrade(id)" value="Penthouse Suite" style="border:none; border-radius: 0%; min-width: 110px;">

                                        <img src="/images/booking-page/penthouseSuite.png">

                                        <div class="card-body" style="background-color: #B3B3B3; text-align: left; padding: 15px">
                                            <h4 class="card-title" style="color: white; font-weight: bold">Penthouse Suite</h4>
                                            <p style="color: white;">Enjoy the finest of our rooms with five-star treatment. Complete with living area, there's space to strech out and enjoy a relaxing stay.</p>
                                            <h5 id="roomUpgrade3Price" style="color: white; text-align: right; font-style: italic;"></h5>
                                        </div>

                                        <span><img id="penthouseSuiteImage" src="/images/booking-page/plusSign.png" width=40%></span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>





            <!--Package holiday section-->
            <div id="packageHolidaySection" style="display: none;">
                <div class="container" style="padding-top: 10px; padding-left: 40px; padding-right: 40px; padding-bottom: 10px;">

                    <div class="card package" id="package1" onclick="selectPackage(id)" style="border-color: white; border-width: 2px; border-radius: 0%; margin-right: 20px;">

                        <span id="package1SelectButton" style="border-radius: 0px; width: 100%; height: 50px; background-color: #004aad; color: white; font-weight: bold; top: 0; left: 0; font-size: 150%; padding-top: 7px; padding-right: 0px">Select</span>

                        <img src="/images/booking-page/bridalBundle.png">

                        <div class="card-body" style="text-align: left; background: rgba(0,0,0,0.7); position: absolute; bottom: 0px; padding-bottom: 0px;">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title" style="color: white; font-weight: bold; text-align: left;">Bridal Bundle</h4>
                                </div>
                                <div class="col">
                                    <h5 id="package1Price" style="color: white; text-align: right; font-style: italic;">£120 per night</h5>
                                </div>
                            </div>

                            <p style="color: white;">A luxurious romantic break with all of the extras to make this the dream holiday you've been wishing for.</p>

                        </div>

                    </div>

                    <br>

                    <div class="card package" id="package2" onclick="selectPackage(id)" style="border-color: white; border-width: 2px;border-radius: 0%; margin-right: 20px;">

                        <span id="package2SelectButton" style="border-radius: 0px; width: 100%; height: 50px; background-color: #004aad; color: white; font-weight: bold; top: 0; left: 0; font-size: 150%; padding-top: 7px; padding-right: 0px">Select</span>

                        <img src="/images/booking-page/seasonalStay.png">

                        <div class="card-body" style="text-align: left; background: rgba(0,0,0,0.7); position: absolute; bottom: 0px; padding-bottom: 0px;">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title" style="color: white; font-weight: bold; text-align: left;">Seasonal Stay</h4>
                                </div>
                                <div class="col">
                                    <h5 id="package2Price" style="color: white; text-align: right; font-style: italic;">£120 per night</h5>
                                </div>
                            </div>

                            <p style="color: white;">Whether it's Spring, Summer, Autumn or Winter we've got you covered. Enjoy a relaxing retreat with different perks depending on the season.</p>

                        </div>

                    </div>

                    <br>

                    <div class="card package" id="package3" onclick="selectPackage(id)" style="border-color: white; border-width: 2px;border-radius: 0%; margin-right: 20px;">

                        <span id="package3SelectButton" style="border-radius: 0px; width: 100%; height: 50px; background-color: #004aad; color: white; font-weight: bold; top: 0; left: 0; font-size: 150%; padding-top: 7px; padding-right: 0px">Select</span>

                        <img src="/images/booking-page/fantasticFamilyPack.png">

                        <div class="card-body" style="text-align: left; background: rgba(0,0,0,0.7); position: absolute; bottom: 0px; padding-bottom: 0px;">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title" style="color: white; font-weight: bold; text-align: left; ;">Fantastic Family Pack</h4>
                                </div>
                                <div class="col">
                                    <h5 id="package3Price" style="color: white; text-align: right; font-style: italic;">£120 per night</h5>
                                </div>
                            </div>

                            <p style="color: white;">Let the kids let off their steam with our countless activities and games while you take a break and relax from the busyness of life.</p>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>


    <!--Price summary section-->
    <div class="container-fluid" id="priceSummarySection" style="background-color: white; align-self: center; display: none; padding-bottom: 20px;">

        <div class="container" id="priceSummaryListings" style="background-color: white; align-self: center; margin-bottom: 0px; margin-top: 10px">
            <div class="row" style="margin-bottom: 0px;">

                <div class="col" style="padding-right: 0px;">
                    <p id="roomSummary" style="color:#737373; text-align: right; font-style: italic;"></p>
                </div>

                <div class="col" style="padding-left: 0px;">
                    <p id="roomPriceSummary" style="color:#737373; text-align: left; font-style: italic;"></p>
                </div>

            </div>
        </div>

        <div class="container" style="background-color: white; align-self: center; margin-bottom: 10px; margin-top: 0px">

            <div class="row">

                <div class="col" style="padding-right: 0px;">
                    <h4 style="color:#737373; text-align: right; font-style: italic; font-weight: bold">Total ...</h4>
                </div>

                <div class="col" style="padding-left: 0px;">
                    <h4 id="totalPriceSummary" style="color:#737373; text-align: left; font-style: italic; font-weight: bold"></h4>
                </div>

            </div>

            <button type="submit" class="btn btn-primary holiday-type" onclick="bookHoliday()" id="countryEscape" style="margin-top: 0; border-radius: 10px; width: 230px; height: 70px; background-color: #004aad; font-weight: bold; font-size: 200%;">Book Now</button>

</form>

</div>

</div>


@endsection