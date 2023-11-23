@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Back</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $hotel->name }}</li>
        </ol>
    </nav>
</div>

<div class="container mt-3">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-sm-4">
                <img src="/storage/{{ $hotel->image }}" class="img-fluid rounded-start" alt="Hotel Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class=" card-title">{{ $hotel->name }}</h2>
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
        <h5 class="card-header">Room Options</h5>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
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
                    <input type="hidden" name="hotel_Id" value="{{ $hotel->id }}">
                    <input type="hidden" name="hotelName" value="{{ $hotel->name }}">
                    <input type="hidden" name="name" value="{{ $hotel->name }}">
                    <input type="hidden" name="userId" value="{{ Auth()->User()->id }}">
                    <input type="hidden" name="email" value="{{ Auth()->User()->email }}">
                    <input type="hidden" name="price" value="{{ $hotel->price}}">
                    <input type="hidden" name="currency" value="{{ 'Sterling' }}">
                    <input type="hidden" name="image" value="{{ $hotel->image }}">
                    <input type="hidden" name="address" value="{{ $hotel->address }}">
                    <input type="hidden" name="town" value="{{ $hotel->town }}">
                    <input type="hidden" name="country" value="{{ $hotel->country}}">
                    <input type="hidden" name="postCode" value="{{ $hotel->postCode }}">
                    <input type="hidden" name="accomType" value="{{ $hotel->accomType }}">
                    <input type="hidden" name="roomType" value="{{ $hotel->roomType }}">
                    <input type="hidden" name="holidayType" value="{{ $hotel->holidayType }}">
                    <input type="hidden" name="feat1Price" value="{{ $hotel->feat1Price }}">
                    <input type="hidden" name="feat2Price" value="{{ $hotel->feat2Price }}">
                    <input type="hidden" name="feat3Price" value="{{ $hotel->feat3Price }}">
                    <input type="hidden" name="feat4Price" value="{{ $hotel->feat4Price }}">
                    <input type="hidden" name="upgrade1Price" value="{{ $hotel->upgrade1Price }}">
                    <input type="hidden" name="upgrade2Price" value="{{ $hotel->upgrade2Price }}">
                    <input type="hidden" name="upgrade3Price" value="{{ $hotel->upgrade3Price }}">
                    <input type="hidden" name="package1Price" value="{{ $hotel->package1Price }}">
                    <input type="hidden" name="package2Price" value="{{ $hotel->package2Price }}">
                    <input type="hidden" name="package3Price" value="{{ $hotel->package3Price }}">
                    <input type="hidden" name="paid" value="{{ 0 }}">
                    <input type="hidden" name="payment_method" value="Stripe">






                    <div class="col" style="text-align: left;">
                        <label class="align-left" style="font-weight: bold; padding-bottom: 15px;">Check in date:</label>
                        <input class="date form-control" id="checkInDate" type="text" name="checkInDate">
                        <label class="align-left mt-3" id="noOfNightsRangeLabel" style="font-weight: bold; padding-bottom: 15px;">No. of Nights: 1</label>
                        <input type="range" onchange="updateNoOfNights(value)" class="form-range" id="noOfNightsRange" min="1" max="30" step="1" value="1" name="numNights">

                    </div>
                    <tbody>
                        <tr>
                            <td>{{ $hotel->roomType }}</td>
                            <td>
                                <ul id="divLeft">
                                    <label><strong>Custom Options</strong></label>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ $hotel->feat1Price }}" id="feat1" name="feat1">{{ $hotel->feat1 }} +£{{ $hotel->feat1Price }}</li>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ $hotel->feat2Price }}" id="feat2" name="feat2">{{ $hotel->feat2 }} +£{{ $hotel->feat2Price }}</li>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ $hotel->feat3Price }}" id="feat3" name="feat3">{{ $hotel->feat3 }} +£{{ $hotel->feat3Price }}</li>
                                    <li><input class="form-check-input me-2" type="checkbox" value="{{ $hotel->feat4Price }}" id="feat4" name="feat4">{{ $hotel->feat4 }} +£{{ $hotel->feat4Price }}</li>

                                    <label><strong>Package Options</strong></label>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="noPackage" name="packageTotal" value="{{ 0 }}" checked>
                                        <label class="form-check-label" for="noPackage">
                                            None
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="package1" name="packageTotal" value="{{ $hotel->package1Price }}">
                                        <label class="form-check-label" for="package1">
                                            {{ $hotel->package1 }} +£{{ $hotel->package1Price }}
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="package2" name="packageTotal" value="{{ $hotel->package2Price }}">
                                        <label class="form-check-label" for="package2">
                                            {{ $hotel->package2 }} +£{{ $hotel->package2Price }}
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="package3" name="packageTotal" value="{{ $hotel->package3Price }}">
                                        <label class="form-check-label" for="package3">
                                            {{ $hotel->package3 }} +£{{ $hotel->package3Price }}
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
                                        <input class="form-check-input" type="radio" id="upgrade1" name="upgradeTotal" value="{{ $hotel->upgrade1Price }}">
                                        <label class="form-check-label" for="upgrade1">
                                            {{ $hotel->upgrade1 }} +£{{ $hotel->upgrade1Price }}
                                        </label>

                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="upgrade2" name="upgradeTotal" value="{{ $hotel->upgrade2Price }}">
                                        <label class="form-check-label" for="upgrade2">
                                            {{ $hotel->upgrade2 }} +£{{ $hotel->upgrade2Price }}
                                        </label>
                                    </div>
                                    <div class="form-check" id="divLeft">
                                        <input class="form-check-input" type="radio" id="upgrade3" name="upgradeTotal" value="{{ $hotel->upgrade3Price }}">
                                        <label class="form-check-label" for="upgrade3">
                                            {{ $hotel->upgrade3 }} +£{{ $hotel->upgrade3Price }}
                                        </label>
                                    </div>
                                </ul>
                            </td>
                            <td>£{{ $hotel->price }}</td>
                            <td>{{ $hotel->numRooms }}</td>
                            <td>
                                <button class="btn btn-primary" type="submit">Book Now</button>
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
    let hotelCost = parseFloat('{{ $hotel->price }}');
    let noOfNights = 1;
    let customCosts = 0;
    let packageCosts = 0;
    let upgradeCosts = 0;
    let totalCost = 0;
    let extrasCost = customCosts + packageCosts + upgradeCosts;
    let upgradeRadioButtons = document.querySelectorAll('input[name="upgradeTotal"]');
    let packageRadioButtons = document.querySelectorAll('input[name="packageTotal"]');
    let checkboxInputs = document.querySelectorAll('input[type="checkbox"]');

    function updateNoOfNights(value) {
        document.getElementById('noOfNightsRangeLabel').innerHTML = "No. of Nights: " + value;
        noOfNights = value;
        let valid = true;

        hotelCost = parseFloat('{{ $hotel->price }}') * noOfNights;

        packageRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                packageCosts = parseFloat(radioButton.value) * noOfNights;
            }
            radioButton.addEventListener('change', function() {
                packageCosts = parseFloat(radioButton.value) * noOfNights;
                calculateExtrasCosts();
                calculateTotalCost();
                updateCostsInHTML(hotelCost, extrasCost, totalCost);
            });
        });

        upgradeRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                upgradeCosts = parseFloat(radioButton.value) * noOfNights;
            }
            radioButton.addEventListener('change', function() {
                upgradeCosts = parseFloat(this.value) * noOfNights;
                calculateExtrasCosts();
                calculateTotalCost();
                updateCostsInHTML(hotelCost, extrasCost, totalCost);
            });
        });

        checkboxInputs.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateCheckboxValue(checkbox);
                calculateExtrasCosts();
                calculateTotalCost();
                updateCostsInHTML(hotelCost, extrasCost, totalCost);
            });
        });

        calculateExtrasCosts();
        calculateTotalCost();
        // Update HTML with dynamic values
        updateCostsInHTML(hotelCost, extrasCost, totalCost);
    }

    function calculateExtrasCosts() {
        extrasCost = upgradeCosts + packageCosts + customCosts;
        return extrasCost;
    }

    function calculateTotalCost() {
        totalCost = hotelCost + extrasCost;
        return totalCost;
    }

    function updateCheckboxValue(checkbox) {
        const featNumber = parseInt(checkbox.dataset.featNumber); // Assuming you have a data attribute for featNumber
        const featPrice = parseFloat(checkbox.value) * noOfNights;
        if (checkbox.checked) {
            customCosts += featPrice;
        } else {
            customCosts -= featPrice;
        }
        return customCosts;
    }

    function updateCostsInHTML(hotelCost, extrasCost, totalCost) {
        document.getElementById('hotelCost').innerText = hotelCost.toFixed(2);
        document.getElementById('extrasCost').innerText = extrasCost.toFixed(2);
        document.getElementById('totalCost').innerText = totalCost.toFixed(2);
    }
</script>


@endsection