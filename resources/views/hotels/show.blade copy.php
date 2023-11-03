@extends('layouts/app')

@section('content')

<script>
    // Displays the custom holiday form and hides the package holiday form.
    function displayCustomHolidayForm() {
        $("#packageHolidaySection").slideUp("slow");
        $("#customHolidaySection").slideDown("slow");

        document.getElementById('customHolidayButton').style.borderWidth = "2px";
        document.getElementById('packageHolidayButton').style.borderWidth = "0px";

        customHoliday = true;

        var selectedRoomType = getSelectedRoomType();

        if (selectedRoomType != null) {
            if (selectedRoomUpgrade != null) {
                updateRoomUpgradePriceSummary();
                document.getElementById('priceSummarySection').style.display = "block";
            } else {
                updateRoomPriceSummary(selectedRoomType);
            }

            updateExtrasPriceSummary();
        } else {
            document.getElementById('priceSummarySection').style.display = "none";
        }
    }

    function displayPackageHolidayForm() {
        $("#customHolidaySection").slideUp("slow")
        $("#packageHolidaySection").slideDown("slow");

        document.getElementById('customHolidayButton').style.borderWidth = "0px";
        document.getElementById('packageHolidayButton').style.borderWidth = "2px";

        customHoliday = false;

        if (selectedPackage != null) {
            updatePackagePriceSummary();
            $("#priceSummarySection").slideDown("slow");
        } else {
            $("#priceSummarySection").slideUp("slow");
        }

        clearExtrasPriceSummaryListings();
    }

    function getSelectedRoomType() {
        if (document.getElementById('roomTypeRadio1').checked) {
            return document.getElementById('roomTypeRadio1').value;
        } else if (document.getElementById('roomTypeRadio2').checked) {
            return document.getElementById('roomTypeRadio2').value;
        } else if (document.getElementById('roomTypeRadio3').checked) {
            return document.getElementById('roomTypeRadio3').value;
        } else if (document.getElementById('roomTypeRadio4').checked) {
            return document.getElementById('roomTypeRadio4').value;
        } else {
            return null;
        }
    }
</script>

<div class="container mt-3">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-sm-4">
                <img src="/storage/{{ $hotel->image }}" class="img-fluid rounded-start" alt="Hotel Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $hotel->name }}</h2>
                    <p class="card-text">{{ $hotel->address }}</p>
                    <p class="card-text">{{ $hotel->town }}</p>
                    <p class="card-text">{{ $hotel->postCode }}</p>
                    <p class="card-text">{{ $hotel->country }}</p>
                    <p class="card-text"><small class="text-body-secondary">Hotel Added: {{ $hotel->created_at->DiffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3">

    <div class="card">
        <h5 class="card-header">Description</h5>
        <div class="card-body">
            <p class="card-text"> {{ $hotel->description }}</p>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">Book Now</h5>
        <div class="container">
            <div class="row">

                <button id="customHolidayButton" class="btn btn-primary" type="button" onclick="displayCustomHolidayForm()">
                    Custom
                </button>
                <button id="packageHolidayButton" class="btn btn-secondary" type="button" onclick="displayPackageHolidayForm()">
                    Package
                </button>
            </div>
        </div>


        <div class="card-body">
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

        </div>
    </div>
</div>
@endsection