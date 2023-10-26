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
    // Reference: https://flaviocopes.com/how-to-format-number-as-currency-javascript/
    const formatter2DecimalPlaces = new Intl.NumberFormat('en-UK', {
        style: 'currency',
        currency: 'GBP',
        minimumFractionDigits: 2
    });
    const formatter0DecimalPlaces = new Intl.NumberFormat('en-UK', {
        style: 'currency',
        currency: 'GBP',
        minimumFractionDigits: 0
    });
</script>


<script>
    const hotels = [{
            type: "City Break",
            location: "Belfast",
            name: "Cityscape Hotel",
            feature1: "3 Restaurants",
            feature2: "Spa",
            feature3: "Prime Location",
            feature4: "Afternoon Tea",
            rate: 1.2
        },
        {
            type: "City Break",
            location: "Dublin",
            name: "Grand Hotel Dublin",
            feature1: "Conference Room",
            feature2: "Fine Dining",
            feature3: "Indoor Gym",
            feature4: "Room Service",
            rate: 1.8
        },
        {
            type: "City Break",
            location: "Cork",
            name: "Finbarr's Hotel",
            feature1: "Swimming Pool",
            feature2: "Afternoon Tea",
            feature3: "Room Service",
            feature4: "Fine Dining",
            rate: 1.2
        },
        {
            type: "Seaside Resort",
            location: "Newcastle",
            name: "Slieve Commedagh Resort",
            feature1: "Beautiful Walks",
            feature2: "Fine Dining",
            feature3: "Spa",
            feature4: "Tennis Courts",
            rate: 1.5
        },
        {
            type: "Seaside Resort",
            location: "Portrush",
            name: "Seaview Hotel",
            feature1: "Conference Room",
            feature2: "Golf Course",
            feature3: "Boat Rides",
            feature4: "Explore the Sights",
            rate: 1
        },
        {
            type: "Seaside Resort",
            location: "Wexford",
            name: "Old Mill Hotel",
            feature1: "Spectacular Views",
            feature2: "Room Service",
            feature3: "Watersports",
            feature4: "Pony Trekking",
            rate: 1.1
        },
        {
            type: "Country Escape",
            location: "Donegal",
            name: "Wild Atlantic Hotel",
            feature1: "Pony Trekking",
            feature2: "Fabulous Gardens",
            feature3: "3 Restaurants",
            feature4: "Spa",
            rate: 1.3
        },
        {
            type: "Country Escape",
            location: "Enniskillen",
            name: "Blue Lake Golf Resort",
            feature1: "Golf Course",
            feature2: "Watersports",
            feature3: "Tennis Courts",
            feature4: "Beautiful Walks",
            rate: 1.6
        },
        {
            type: "Country Escape",
            location: "Wicklow",
            name: "Powerhouse Hotel",
            feature1: "Swimming Pool",
            feature2: "Room Service",
            feature3: "Fabulous Gardens",
            feature4: "Indoor Gym",
            rate: 1.1
        }
    ];
    const hotelFeatures = [{
            imageText: "3 Restaurants",
            imagesource: "/images/booking-page/restaurant.png",
            extra: false,
            price: 0
        },
        {
            imageText: "Golf Course",
            imagesource: "/images/booking-page/golfCourse.png",
            extra: true,
            price: 30
        },
        {
            imageText: "Spa",
            imagesource: "/images/booking-page/spa.png",
            extra: true,
            price: 40
        },
        {
            imageText: "Tennis Courts",
            imagesource: "/images/booking-page/tennisCourts.png",
            extra: true,
            price: 20
        },
        {
            imageText: "Afternoon Tea",
            imagesource: "/images/booking-page/afternoonTea.png",
            extra: true,
            price: 25
        },
        {
            imageText: "Beautiful Walks",
            imagesource: "/images/booking-page/beautifulWalks.png",
            extra: false,
            price: 0
        },
        {
            imageText: "Boat Rides",
            imagesource: "/images/booking-page/boatRides.png",
            extra: true,
            price: 45
        },
        {
            imageText: "Spectacular Views",
            imagesource: "/images/booking-page/cottageByTheSea.png",
            extra: false,
            price: 0
        },
        {
            imageText: "Explore the Sights",
            imagesource: "/images/booking-page/dunluceCastle.png",
            extra: false,
            price: 0
        },
        {
            imageText: "Fine Dining",
            imagesource: "/images/booking-page/fineDining.png",
            extra: false,
            price: 0
        },
        {
            imageText: "Indoor Gym",
            imagesource: "/images/booking-page/gym.png",
            extra: true,
            price: 25
        },
        {
            imageText: "Fabulous Gardens",
            imagesource: "/images/booking-page/hotelGardens.png",
            extra: false,
            price: 0
        },
        {
            imageText: "Conference Room",
            imagesource: "/images/booking-page/meetingRoom.png",
            extra: true,
            price: 100
        },
        {
            imageText: "Pony Trekking",
            imagesource: "/images/booking-page/ponyTrekking.png",
            extra: true,
            price: 40
        },
        {
            imageText: "Room Service",
            imagesource: "/images/booking-page/roomService.png",
            extra: true,
            price: 80
        },
        {
            imageText: "Swimming Pool",
            imagesource: "/images/booking-page/swimmingPool.png",
            extra: true,
            price: 30
        },
        {
            imageText: "Prime Location",
            imagesource: "/images/booking-page/victoriaSquare.png",
            extra: false,
            price: 0
        },
        {
            imageText: "Watersports",
            imagesource: "/images/booking-page/watersports.png",
            extra: true,
            price: 50
        }
    ];
    const baseRates = {
        singleRoom: 60,
        doubleRoom: 100,
        twinRoom: 100,
        familyRoom: 150,
        roomUpgrade1: 170,
        roomUpgrade2: 200,
        roomUpgrade3: 260,
        package1: 250,
        package2: 240,
        package3: 230
    };

    var prices = {
        singleRoom: 0,
        doubleRoom: 0,
        twinRoom: 0,
        familyRoom: 0,
        roomUpgrade1: 0,
        roomUpgrade2: 0,
        roomUpgrade3: 0,
        extrasRate: 0,
        package1: 0,
        package2: 0,
        package3: 0
    };
    var customHoliday = true;
    var noOfNights = 1;
    var roomPrice = 0;
    var extrasPrice = 0;
    var upgradePrice = 0;
    var packagePrice = 0;
    var selectedRoomUpgrade = null;
    var selectedPackage = null;

    function checkPreselectedHotelType() {
        var preselectedHotelType = localStorage.getItem("preselectedHotelType");

        if (preselectedHotelType != "null") {
            selectHotelType(preselectedHotelType);
            localStorage.setItem("preselectedHotelType", "null");
        }
    }

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

    function clearLocationDropdown() {
        for (i = document.getElementById('locationDropdown').options.length - 1; i >= 0; i--) {
            document.getElementById('locationDropdown').options[i] = null;
        }
    }

    function createLocationOption(element, text, value) {
        var option = document.createElement('option');
        option.text = text;
        option.value = value;
        element.options.add(option);
    }

    function clearRoomTypeRadios() {
        document.getElementById('roomTypeRadio1').checked = false;
        document.getElementById('roomTypeRadio2').checked = false;
        document.getElementById('roomTypeRadio3').checked = false;
        document.getElementById('roomTypeRadio4').checked = false;
    }



    function clearExtrasCheckboxes() {
        for (i = document.getElementById('extrasCheckbox').childElementCount; i > 2; i--) {
            document.getElementById('extrasCheckbox').removeChild(document.getElementById('extrasCheckbox').lastChild);
        }
        uncheckStandardExtrasCheckboxes();
    }

    function uncheckStandardExtrasCheckboxes() {
        document.getElementById('extrasCheckbox1').checked = false;
        document.getElementById('extrasCheckbox2').checked = false;
    }

    function selectLocation(hotelLocation) {
        $("#hotelFeaturesSection").slideUp("slow", function() {
            customHoliday = true;

            clearRoomTypeRadios();
            displayCustomHolidayForm();
            clearExtrasCheckboxes();
            resetPrices();
            clearExtrasPriceSummaryListings();
            enableDisableRoomTypeRadios(false);
            resetRoomUpgradeSelection();
            resetPackageSelection();

            document.getElementById('noLocationSelectedErrorMessage').style.display = "none";

            if (document.getElementById('locationDropdown').options[0].text == "") {
                console.log("Testtt")
                document.getElementById('locationDropdown').options[0] = null;
            }

            console.log("Test: " + hotels[0].feature4)

            for (i = 0; i < hotels.length; i++) {
                console.log(i);
                if (hotelLocation == hotels[i].location) {
                    calculateRates(hotels[i].rate);
                    setRoomUpgradePrices();
                    setPackagePrices();

                    console.log(hotels[i].name);
                    console.log(hotels[i]);

                    document.getElementById('hotelName').innerHTML = hotels[i].name;

                    hotelFeature1 = getHotelFeature(hotels[i].feature1);
                    hotelFeature2 = getHotelFeature(hotels[i].feature2);
                    hotelFeature3 = getHotelFeature(hotels[i].feature3);
                    hotelFeature4 = getHotelFeature(hotels[i].feature4);

                    document.getElementById('hotelFeature1Text').innerHTML = hotels[i].feature1;
                    document.getElementById('hotelFeature1Image').src = hotelFeature1.imagesource;

                    if (hotelFeature1.extra) {
                        createExtrasCheckbox(document.getElementById('extrasCheckbox'), hotelFeature1.imageText, "extrasCheckbox3", hotelFeature1.price);
                    }

                    document.getElementById('hotelFeature2Text').innerHTML = hotels[i].feature2;
                    document.getElementById('hotelFeature2Image').src = hotelFeature2.imagesource;

                    if (hotelFeature2.extra) {
                        createExtrasCheckbox(document.getElementById('extrasCheckbox'), hotelFeature2.imageText, "extrasCheckbox4", hotelFeature2.price);
                    }

                    document.getElementById('hotelFeature3Text').innerHTML = hotels[i].feature3;
                    document.getElementById('hotelFeature3Image').src = hotelFeature3.imagesource;

                    if (hotelFeature3.extra) {
                        createExtrasCheckbox(document.getElementById('extrasCheckbox'), hotelFeature3.imageText, "extrasCheckbox5", hotelFeature3.price);
                    }

                    document.getElementById('hotelFeature4Text').innerHTML = hotels[i].feature4;
                    document.getElementById('hotelFeature4Image').src = hotelFeature4.imagesource;

                    if (hotelFeature4.extra) {
                        createExtrasCheckbox(document.getElementById('extrasCheckbox'), hotelFeature4.imageText, "extrasCheckbox6", hotelFeature4.price);
                    }

                }
            }

            if (!hasCheckInDateBeenSelected()) {
                document.getElementById('noCheckInDateEnteredErrorMessage').style.display = "block";
            } else {
                document.getElementById('roomUpgradeSection').style.display = "none";
                document.getElementById('priceSummarySection').style.display = "none";

                $("#hotelFeaturesSection").slideDown("slow");
                $("#holidayTypeSelectionSection").slideDown("slow");
                $("#holidayTypesSection").slideDown("slow");
            }
        });
    }

    function resetNoOfNights() {
        document.getElementById('noOfNightsRange').value = 1;
        document.getElementById('noOfNightsRangeLabel').innerHTML = "No. of Nights: 1";
        noOfNights = 1;
    }

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

    function calculateRates(hotelRate) {
        prices.singleRoom = baseRates.singleRoom * hotelRate;
        prices.doubleRoom = baseRates.doubleRoom * hotelRate;
        prices.twinRoom = baseRates.twinRoom * hotelRate;
        prices.familyRoom = baseRates.familyRoom * hotelRate;

        prices.roomUpgrade1 = baseRates.roomUpgrade1 * hotelRate;
        prices.roomUpgrade2 = baseRates.roomUpgrade2 * hotelRate;
        prices.roomUpgrade3 = baseRates.roomUpgrade3 * hotelRate;

        prices.extrasRate = hotelRate;

        prices.package1 = baseRates.package1 * hotelRate;
        prices.package2 = baseRates.package2 * hotelRate;
        prices.package3 = baseRates.package3 * hotelRate;
    }

    function updateRoomPriceSummary(value) {
        document.getElementById('noRoomTypeSelectedErrorMessage').style.display = "none";

        $("#priceSummarySection").slideDown("slow");
        $("#roomUpgradeSection").slideDown("slow");

        roomPrice = 0;

        console.log(value);

        if (value == "Single") {
            roomPrice = prices.singleRoom * noOfNights;
        } else if (value == "Double") {
            roomPrice = prices.doubleRoom * noOfNights;
        } else if (value == "Twin") {
            roomPrice = prices.twinRoom * noOfNights;
        } else if (value == "Family") {
            roomPrice = prices.familyRoom * noOfNights;
        }

        if (noOfNights > 1) {
            document.getElementById('roomSummary').innerHTML = value + ' Room for ' + noOfNights + ' Nights ...';
        } else {
            document.getElementById('roomSummary').innerHTML = value + ' Room for ' + noOfNights + ' Night ...';
        }

        document.getElementById('roomPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format(roomPrice);
        document.getElementById('totalPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format((roomPrice + extrasPrice));
    }

    function updateExtrasPriceSummary() {
        clearExtrasPriceSummaryListings();

        if (getSelectedRoomType() == null) {
            document.getElementById('noRoomTypeSelectedErrorMessage').style.display = "block";
        }

        extrasPrice = 0;

        if (document.getElementById('extrasCheckbox1').checked == true) {
            extrasPrice += prices.extrasRate * document.getElementById('extrasCheckbox1').value;
            addExtraPriceListing(document.getElementById('extrasCheckbox1').name, (prices.extrasRate * document.getElementById('extrasCheckbox1').value));
        }
        if (document.getElementById('extrasCheckbox2').checked == true) {
            extrasPrice += prices.extrasRate * document.getElementById('extrasCheckbox2').value;
            addExtraPriceListing(document.getElementById('extrasCheckbox2').name, (prices.extrasRate * document.getElementById('extrasCheckbox2').value));
        }

        if (document.getElementById('extrasCheckbox3')) {
            if (document.getElementById('extrasCheckbox3').checked == true) {
                extrasPrice += prices.extrasRate * document.getElementById('extrasCheckbox3').value;
                addExtraPriceListing(document.getElementById('extrasCheckbox3').name, (prices.extrasRate * document.getElementById('extrasCheckbox3').value));

                console.log(document.getElementById('extrasCheckbox3').value);
            }
        }
        if (document.getElementById('extrasCheckbox4')) {
            if (document.getElementById('extrasCheckbox4').checked == true) {
                extrasPrice += prices.extrasRate * document.getElementById('extrasCheckbox4').value;
                addExtraPriceListing(document.getElementById('extrasCheckbox4').name, (prices.extrasRate * document.getElementById('extrasCheckbox4').value));

                console.log(document.getElementById('extrasCheckbox4').value);
            }
        }
        if (document.getElementById('extrasCheckbox5')) {
            if (document.getElementById('extrasCheckbox5').checked == true) {
                extrasPrice += prices.extrasRate * document.getElementById('extrasCheckbox5').value;
                addExtraPriceListing(document.getElementById('extrasCheckbox5').name, (prices.extrasRate * document.getElementById('extrasCheckbox5').value));

                console.log(document.getElementById('extrasCheckbox5').value);
            }
        }
        if (document.getElementById('extrasCheckbox6')) {
            if (document.getElementById('extrasCheckbox6').checked == true) {
                extrasPrice += prices.extrasRate * document.getElementById('extrasCheckbox6').value;
                addExtraPriceListing(document.getElementById('extrasCheckbox6').name, (prices.extrasRate * document.getElementById('extrasCheckbox6').value));

                console.log(document.getElementById('extrasCheckbox6').value);
            }
        }

        if (selectedRoomUpgrade != null) {
            document.getElementById('totalPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format((upgradePrice + extrasPrice));
        } else {
            document.getElementById('totalPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format((roomPrice + extrasPrice));
        }

        console.log(extrasPrice);
    }

    function addExtraPriceListing(extraText, extraPrice) {
        var paragraphExtraSummary = document.createElement('p');
        paragraphExtraSummary.style = "color:#737373; text-align: right; font-style: italic;";
        paragraphExtraSummary.innerHTML = extraText + " ...";

        console.log(paragraphExtraSummary.innerHTML);

        var columnExtraSummary = document.createElement('div');
        columnExtraSummary.className = "col";
        columnExtraSummary.style = "padding-right: 0px;";
        columnExtraSummary.appendChild(paragraphExtraSummary);

        console.log(extraText);
        console.log(extraPrice);

        var paragraphExtraPrice = document.createElement('p');
        paragraphExtraPrice.style = "color:#737373; text-align: left; font-style: italic;";
        paragraphExtraPrice.innerHTML = "... " + formatter2DecimalPlaces.format(extraPrice);

        var columnExtraPrice = document.createElement('div');
        columnExtraPrice.className = "col";
        columnExtraPrice.style = "padding-left: 0px;";
        columnExtraPrice.appendChild(paragraphExtraPrice);


        var rowExtra = document.createElement('div');
        rowExtra.className = "row";
        rowExtra.appendChild(columnExtraSummary);
        rowExtra.appendChild(columnExtraPrice);


        document.getElementById('priceSummaryListings').appendChild(rowExtra);
    }

    function updatePackagePriceSummary() {
        var packageName = "";

        $("#priceSummarySection").slideDown("slow");

        packagePrice = 0;

        if (selectedPackage == "package1") {
            packagePrice = prices.package1 * noOfNights;
            packageName = "Bridal Bundle";
        } else if (selectedPackage == "package2") {
            packagePrice = prices.package2 * noOfNights;
            packageName = "Seasonal Stay";
        } else {
            packagePrice = prices.package3 * noOfNights;
            packageName = "Fantastic Family Pack";
        }

        if (noOfNights > 1) {
            document.getElementById('roomSummary').innerHTML = packageName + ' for ' + noOfNights + ' Nights ...';
        } else {
            document.getElementById('roomSummary').innerHTML = packageName + ' for ' + noOfNights + ' Night ...';
        }

        document.getElementById('roomPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format(packagePrice);
        document.getElementById('totalPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format(packagePrice);
    }


    function resetPrices() {
        roomPrice = 0;
        extrasPrice = 0;
        upgradePrice = 0;
        packagePrice = 0;
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

    function createExtrasCheckbox(element, text, id, value) {
        var formCheckDiv = document.createElement('div');
        formCheckDiv.className = "form-check";
        formCheckDiv.style = "text-align: left;";

        var input = document.createElement('input');
        input.value = value;
        console.log("value is:" + value);
        input.className = "form-check-input";
        input.type = "checkbox";
        input.id = id;
        input.name = text;
        input.onclick = function() {
            updateExtrasPriceSummary()
        };

        var label = document.createElement('label');
        label.innerHTML = text;
        label.className = "form-check-label";

        formCheckDiv.appendChild(input);
        formCheckDiv.appendChild(label);

        element.appendChild(formCheckDiv);
    }

    function clearExtrasPriceSummaryListings() {
        for (i = document.getElementById('priceSummaryListings').childElementCount; i > 1; i--) {
            document.getElementById('priceSummaryListings').removeChild(document.getElementById('priceSummaryListings').lastChild);
        }
    }

    function resetRoomUpgradeSelection() {
        if (selectedRoomUpgrade != null) {
            document.getElementById(selectedRoomUpgrade + "Image").src = "/images/booking-page/plusSign.png";
        }
    }

    function setRoomUpgradePrices() {
        document.getElementById('roomUpgrade1Price').innerHTML = formatter0DecimalPlaces.format(prices.roomUpgrade1) + " per night";
        document.getElementById('roomUpgrade2Price').innerHTML = formatter0DecimalPlaces.format(prices.roomUpgrade2) + " per night";
        document.getElementById('roomUpgrade3Price').innerHTML = formatter0DecimalPlaces.format(prices.roomUpgrade3) + " per night";
    }

    function setPackagePrices() {
        document.getElementById('package1Price').innerHTML = formatter0DecimalPlaces.format(prices.package1) + " per night";
        document.getElementById('package2Price').innerHTML = formatter0DecimalPlaces.format(prices.package2) + " per night";
        document.getElementById('package3Price').innerHTML = formatter0DecimalPlaces.format(prices.package3) + " per night";
    }

    function selectRoomUpgrade(value) {
        console.log(value);
        console.log(selectedRoomUpgrade);

        if (value == selectedRoomUpgrade) {
            document.getElementById(value + "Image").src = "/images/booking-page/plusSign.png";
            selectedRoomUpgrade = null;
            enableDisableRoomTypeRadios(false);

            updateRoomPriceSummary(getSelectedRoomType());
        } else {
            document.getElementById(value + "Image").src = "/images/booking-page/minusSign.png";
            selectedRoomUpgrade = value;
            enableDisableRoomTypeRadios(true);

            updateRoomUpgradePriceSummary();
        }
    }

    function resetPackageSelection() {
        if (selectedPackage != null) {
            document.getElementById(selectedPackage + "SelectButton").style.backgroundColor = "#004aad";
            document.getElementById(selectedPackage + "SelectButton").innerHTML = "Select";
            selectedPackage = null;
        }
    }

    function selectPackage(value) {
        console.log(value);

        if (value != selectedPackage) {
            if (value == "package1") {
                document.getElementById("package1SelectButton").innerHTML = "Selected";
                document.getElementById("package1SelectButton").style.backgroundColor = "#598433";

                document.getElementById("package2SelectButton").innerHTML = "Select";
                document.getElementById("package2SelectButton").style.backgroundColor = "#004aad";

                document.getElementById("package3SelectButton").innerHTML = "Select";
                document.getElementById("package3SelectButton").style.backgroundColor = "#004aad";
            } else if (value == "package2") {
                document.getElementById("package2SelectButton").innerHTML = "Selected";
                document.getElementById("package2SelectButton").style.backgroundColor = "#598433";

                document.getElementById("package1SelectButton").innerHTML = "Select";
                document.getElementById("package1SelectButton").style.backgroundColor = "#004aad";

                document.getElementById("package3SelectButton").innerHTML = "Select";
                document.getElementById("package3SelectButton").style.backgroundColor = "#004aad";
            } else {
                document.getElementById("package3SelectButton").innerHTML = "Selected";
                document.getElementById("package3SelectButton").style.backgroundColor = "#598433";

                document.getElementById("package1SelectButton").innerHTML = "Select";
                document.getElementById("package1SelectButton").style.backgroundColor = "#004aad";

                document.getElementById("package2SelectButton").innerHTML = "Select";
                document.getElementById("package2SelectButton").style.backgroundColor = "#004aad";
            }
            selectedPackage = value;

            updatePackagePriceSummary();
        }

        console.log(selectedPackage);
    }

    function updateRoomUpgradePriceSummary() {
        var roomUpgradeText = "";

        if (selectedRoomUpgrade == "juniorSuite") {
            document.getElementById("bridalSuiteImage").src = "/images/booking-page/plusSign.png";
            document.getElementById("penthouseSuiteImage").src = "/images/booking-page/plusSign.png";

            upgradePrice = prices.roomUpgrade1 * noOfNights;

            roomUpgradeText = "Junior Suite";
        } else if (selectedRoomUpgrade == "bridalSuite") {
            document.getElementById("juniorSuiteImage").src = "/images/booking-page/plusSign.png";
            document.getElementById("penthouseSuiteImage").src = "/images/booking-page/plusSign.png";

            upgradePrice = prices.roomUpgrade2 * noOfNights;

            roomUpgradeText = "Bridal Suite";
        } else {
            document.getElementById("juniorSuiteImage").src = "/images/booking-page/plusSign.png";
            document.getElementById("bridalSuiteImage").src = "/images/booking-page/plusSign.png";

            upgradePrice = prices.roomUpgrade3 * noOfNights;

            roomUpgradeText = "Penthouse Suite";
        }

        if (noOfNights > 1) {
            document.getElementById('roomSummary').innerHTML = roomUpgradeText + ' for ' + noOfNights + ' Nights ...';
        } else {
            document.getElementById('roomSummary').innerHTML = roomUpgradeText + ' for ' + noOfNights + ' Night ...';
        }

        document.getElementById('roomPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format(upgradePrice);
        document.getElementById('totalPriceSummary').innerHTML = '... ' + formatter2DecimalPlaces.format((upgradePrice + extrasPrice));
    }

    // If value is true this will disable the room type radio buttons.
    // If value is false this will enable the room type radio buttons.    
    function enableDisableRoomTypeRadios(value) {
        document.getElementById('roomTypeRadio1').disabled = value;
        document.getElementById('roomTypeRadio2').disabled = value;
        document.getElementById('roomTypeRadio3').disabled = value;
        document.getElementById('roomTypeRadio4').disabled = value;
    }

    function hasLocationBeenSelected() {
        if (document.getElementById('locationDropdown').value == "null") {
            return false;
        } else {
            return true;
        }
    }

    function hasCheckInDateBeenSelected() {
        if (document.getElementById('checkInDate').value == "") {
            return false;
        } else {
            return true;
        }
    }

    // Returns the hotel feature that matches the value passed in.
    function getHotelFeature(imageTextParam) {
        for (j = 0; j < hotelFeatures.length; j++) {
            if (imageTextParam == hotelFeatures[j].imageText) {
                console.log(hotelFeatures[j]);
                return hotelFeatures[j];
            }
        }
    }

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

    /// Displays the package holiday form and hides the custom holiday form.
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

    // Stores the total price and the hotel name in localstorage to be used in the payment page.
    // Then sends the user to the payment page.
    function bookHoliday() {
        var totalPrice = 0;

        if (customHoliday) {
            if (selectedRoomUpgrade == null) {
                totalPrice = roomPrice + extrasPrice;
            } else {
                totalPrice = upgradePrice + extrasPrice;
            }

        } else {
            totalPrice = packagePrice;
        }

        localStorage.setItem("hotelName", document.getElementById('hotelName').innerHTML);
        localStorage.setItem("totalPrice", totalPrice);

        window.location.href = "PaymentPage.html";
    }

    // Reference: https://dev.to/ara225/how-to-use-bootstrap-modals-without-jquery-3475
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
</script>




<!--Main body of page-->



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