@extends('layouts/app')

@section('content')
<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li>Edit Booking Details at {{ $booking->name }}</li>
    </ul>
</div>

<div class="container mt-3">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-sm-4">
                <img src="/storage/{{ $booking->image }}" class="img-fluid rounded-start" alt="Hotel Image">
            </div>
            <div class="col-md-8">
                <div class="card-body" id="divLeft">
                    <h2 class="card-title">{{ $booking->name }}</h2>
                    <p class="card-text">{{ $booking->address }}</p>
                    <p class="card-text">{{ $booking->town }}</p>
                    <p class="card-text">{{ $booking->postCode }}</p>
                    <p class="card-text">{{ $booking->country }}</p>
                    <p class="card-text"><small class="text-body-secondary">Hotel Booked: {{ $booking->created_at->DiffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3">
    <div class="card">
        <h5 class="card-header" id="divLeft">Room Options</h5>
        <div class="card-body" id="divLeft">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Room Type</th>
                        <th scope="col">Extras</th>
                        <th scope="col">Price</th>
                        <th scope="col">Available Rooms</th>
                        <th scope="col">Book Now</th>
                    </tr>
                </thead>

                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="hotel_Id" value="{{ $booking->id }}">

                    <input type="hidden" name="name" value="{{ $booking->name }}">
                    <input type="hidden" name="userId" value="{{ Auth()->User()->id }}">
                    <input type="hidden" name="email" value="{{ Auth()->User()->email }}">
                    <input type="hidden" name="pricePN" value="{{ $booking->pricePN}}">
                    <input type="hidden" name="currency" value="{{ 'Sterling' }}">
                    <input type="hidden" name="image" value="{{ $booking->image }}">
                    <input type="hidden" name="address" value="{{ $booking->address }}">
                    <input type="hidden" name="town" value="{{ $booking->town }}">
                    <input type="hidden" name="country" value="{{ $booking->country}}">
                    <input type="hidden" name="postCode" value="{{ $booking->postCode }}">
                    <input type="hidden" name="accomType" value="{{ $booking->accomType }}">
                    <input type="hidden" name="roomType" value="{{ $booking->roomType }}">
                    <input type="hidden" name="holidayType" value="{{ $booking->holidayType }}">
                    <input type="hidden" name="feat1Price" value="{{ $booking->feat1Price }}">
                    <input type="hidden" name="feat2Price" value="{{ $booking->feat2Price }}">
                    <input type="hidden" name="feat3Price" value="{{ $booking->feat3Price }}">
                    <input type="hidden" name="feat4Price" value="{{ $booking->feat4Price }}">
                    <input type="hidden" name="upgrade1Price" value="{{ $booking->upgrade1Price }}">
                    <input type="hidden" name="upgrade2Price" value="{{ $booking->upgrade2Price }}">
                    <input type="hidden" name="upgrade3Price" value="{{ $booking->upgrade3Price }}">
                    <input type="hidden" name="package1Price" value="{{ $booking->package1Price }}">
                    <input type="hidden" name="package2Price" value="{{ $booking->package2Price }}">
                    <input type="hidden" name="package3Price" value="{{ $booking->package3Price }}">
                    <input type="hidden" name="paid" value="{{ 0 }}">
                    <input type="hidden" name="payment_method" value="Stripe">






                    <div class="col" style="text-align: left;">
                        <label class="align-left" style="font-weight: bold; padding-bottom: 15px;">Check in date:</label>
                        <input class="date form-control" id="checkInDate" type="text" name="checkInDate" value="{{ old('checkInDate'), $booking->checkInDate }}">
                        <label class="align-left mt-3" id="noOfNightsRangeLabel" style="font-weight: bold; padding-bottom: 15px;">No. of Nights: {{ $booking->numNights }}</label>
                        <input type="range" onchange="updateNoOfNights(value)" class="form-range" id="noOfNightsRange" min="1" max="30" step="1" value="{{ old('numNights'), $booking->numNights }}" name="numNights">

                    </div>
                    <tbody>
                        <tr>
                            <td>{{ $booking->roomType }}</td>
                            <td>
                                <ul id="divLeft">
                                    <label><strong>Custom Options</strong></label>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ old('feat1', $booking->feat1) }}" id="feat1" name="feat1">{{ $booking->feat1 }} +£{{ $booking->feat1Price }}</li>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ old('feat1Price', $booking->feat1Price) }}" id="feat2" name="feat2">{{ $booking->feat2 }} +£{{ $booking->feat2Price }}</li>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ old('feat3', $booking->feat3) }}" id="feat3" name="feat3">{{ $booking->feat3 }} +£{{ $booking->feat3Price }}</li>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ old('feat4Price', $booking->feat4Price) }}" id="feat4" name="feat4">{{ $booking->feat4 }} +£{{ $booking->feat4Price }}</li>

                                    <label><strong>Package Options</strong></label>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="noPackage" name="packageTotal" value="{{ 0 }}" checked>
                                        <label class="form-check-label" for="noPackage">
                                            None
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="package1" name="packageTotal" value="{{ old('package1Price', $booking->package1Price) }}">
                                        <label class="form-check-label" for="package1">
                                            {{ $booking->package1 }} +£{{ $booking->package1Price }}
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="package2" name="packageTotal" value="{{ old('package2', $booking->package2) }}">
                                        <label class="form-check-label" for="package2">
                                            {{ $booking->package2 }} +£{{ $booking->package2Price }}
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="package3" name="packageTotal" value="{{ old('package3', $booking->package3) }}">
                                        <label class="form-check-label" for="package3">
                                            {{ $booking->package3 }} +£{{ $booking->package3Price }}
                                        </label>
                                    </div>



                                    <label><strong>Upgrade Options</strong></label>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="noUpgrade" name="upgradeTotal" value="{{ 0 }}" checked>
                                        <label class="form-check-label" for="noUpgrade">
                                            None
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="upgrade1" name="upgradeTotal" value="{{ old('upgrade1', $booking->upgrade1) }}">
                                        <label class="form-check-label" for="upgrade1">
                                            {{ $booking->upgrade1 }} +£{{ $booking->upgrade1Price }}
                                        </label>

                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="upgrade2" name="upgradeTotal" value="{{ old('upgrade2', $booking->upgrade2) }}">
                                        <label class="form-check-label" for="upgrade2">
                                            {{ $booking->upgrade2 }} +£{{ $booking->upgrade2Price }}
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="upgrade3" name="upgradeTotal" value="{{ old('upgrade3', $booking->upgrade3) }}">
                                        <label class="form-check-label" for="upgrade3">
                                            {{ $booking->upgrade3 }} +£{{ $booking->upgrade3Price }}
                                        </label>
                                    </div>
                                </ul>
                            </td>
                            <td>{{ $booking->price }}</td>
                            <td>{{ $booking->numRooms }}</td>
                            <td>
                                <button class="btn btn-primary" type="submit">Edit Booking</button>
                            </td>
                        </tr>
                    </tbody>

            </table>
        </div>
        <div class="mt-3 text-center">
            <h2>Your hotel room cost: £<span id="hotelCost">0</span></h2>
            <h2>Your total extras cost: £<span id="extrasCost">0</span></h2>
            <h2>Your total costs: £<span id="totalCost">0</span></span></h2>
        </div>
        </form>
    </div>
</div>



<script type="text/javascript">
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>

<script>
    let hotelCost = parseFloat('{{ $booking->pricePN }}');
    let noOfNights = 0;
    let customCosts = 0;
    let packageCosts = 0;
    let upgradeCosts = 0;
    let totalCost = 0;
    let extrasCost = customCosts + packageCosts + upgradeCosts;
    let upgradeRadioButtons = document.querySelectorAll('input[name="upgradeTotal"]');
    let packageRadioButtons = document.querySelectorAll('input[name="packageTotal"]');

    function updateNoOfNights(value) {
        document.getElementById('noOfNightsRangeLabel').innerHTML = "No. of Nights: " + value;
        noOfNights = value;
        let valid = true;

        hotelCost = parseFloat('{{ $booking->pricePN }}') * noOfNights;



        // Add event listeners to checkboxes
        document.getElementById('feat1').addEventListener('change', function() {
            updateCheckboxValue(this, 1);
        });

        document.getElementById('feat2').addEventListener('change', function() {
            updateCheckboxValue(this, 2);
        });

        document.getElementById('feat3').addEventListener('change', function() {
            updateCheckboxValue(this, 3);
        });

        document.getElementById('feat4').addEventListener('change', function() {
            updateCheckboxValue(this, 4);
        });


        packageRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                packageCosts = parseFloat(radioButton.value) * noOfNights;
            }
            radioButton.addEventListener('change', function() {
                packageCosts = parseFloat(radioButton.value) * noOfNights;
                extrasCost = upgradeCosts + packageCosts;
                totalCost = hotelCost + extrasCost;
                updateCostsInHTML(hotelCost, extrasCost, totalCost);
            });

        });


        upgradeRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                upgradeCosts = parseFloat(radioButton.value) * noOfNights;
            }
            radioButton.addEventListener('change', function() {
                upgradeCosts = parseFloat(this.value) * noOfNights;
                extrasCost = upgradeCosts + packageCosts;
                totalCost = hotelCost + extrasCost;
                updateCostsInHTML(hotelCost, extrasCost, totalCost);
            });


        });



        extrasCost = upgradeCosts + packageCosts;
        totalCost = hotelCost + extrasCost;
        // Update HTML with dynamic values
        updateCostsInHTML(hotelCost, extrasCost, totalCost);



    }


    function calculateHotelCosts() {
        hotelCost = hotelCost * noOfNights;
        return hotelCost;
    }

    function calculateTotalCost() {
        return hotelCost + extrasCost;
    }


    function updateCheckboxValue(checkbox, featNumber) {
        const featPrice = parseFloat(checkbox.value) * noOfNights;
        if (checkbox.checked) {
            extrasCost += featPrice;
        } else {
            extrasCost -= featPrice;
        }
        totalCost = calculateTotalCost();
        updateCostsInHTML(hotelCost, extrasCost, totalCost);
    }


    function updateCostsInHTML(hotelCost, extrasCost, totalCost) {
        document.getElementById('hotelCost').innerText = hotelCost.toFixed(2);
        document.getElementById('extrasCost').innerText = extrasCost.toFixed(2);
        document.getElementById('totalCost').innerText = totalCost.toFixed(2);
    }
</script>


@endsection