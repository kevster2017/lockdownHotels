@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/">Back</a></li>
      <li class="breadcrumb-item active" aria-current="page">Your cart</li>
    </ol>
  </nav>
</div>

<div class="container mt-3">
  <div class="card mb-3">
    <div class="row g-0">
      <div class="col-sm-4">
        <img src="/storage/{{ $cart->image }}" class="img-responsive rounded-start" alt="cart Image">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h2 class="card-title">{{ $cart->name }}</h2>
          @for ($i = 1; $i <= $cart->hotel->stars; $i++)
            <span> <i class="fa-solid fa-star mb-3" style="color:gold"></i></span>
            @endfor
            <p class="card-text">{{ $cart->address }}</p>
            <p class="card-text">{{ $cart->town }}</p>
            <p class="card-text">{{ $cart->postCode }}</p>
            <p class="card-text">{{ $cart->country }}</p>
            <p class="card-text"><small class="text-body-secondary">Booking Created: {{ $cart->created_at->diffForHumans() }}</small></p>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="container mt-3">
  <div class="card">
    <h5 class="card-header">Add Extras</h5>
    <div class="card-body">
      <form action="{{ route('cart.update', $cart->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table class="table table-bordered table-hover">
          <thead class="table-primary">
            <tr>
              <th scope="col">Room Type</th>
              <th scope="col">Extras (Per Night)</th>
              <th scope="col">Hotel Room (Per Night)</th>

            </tr>
          </thead>


          <input type="hidden" name="cart_Id" value="{{ $cart->id }}">
          <input type="hidden" name="cartName" value="{{ $cart->name }}">
          <input type="hidden" name="name" value="{{ $cart->name }}">
          <input type="hidden" name="userId" value="{{ Auth()->User()->id }}">

          <input type="hidden" name="price" value="{{ $cart->price}}">
          <input type="hidden" name="currency" value="{{ 'Sterling' }}">
          <input type="hidden" name="image" value="{{ $cart->image }}">
          <input type="hidden" name="address" value="{{ $cart->address }}">
          <input type="hidden" name="town" value="{{ $cart->town }}">
          <input type="hidden" name="country" value="{{ $cart->country}}">
          <input type="hidden" name="postCode" value="{{ $cart->postCode }}">
          <input type="hidden" name="accomType" value="{{ $cart->accomType }}">
          <input type="hidden" name="roomType" value="{{ $cart->roomType }}">
          <input type="hidden" name="holidayType" value="{{ $cart->holidayType }}">
          <input type="hidden" name="feat1Price" value="{{ $cart->feat1Price }}">
          <input type="hidden" name="feat2Price" value="{{ $cart->feat2Price }}">
          <input type="hidden" name="feat3Price" value="{{ $cart->feat3Price }}">
          <input type="hidden" name="feat4Price" value="{{ $cart->feat4Price }}">



          <input type="hidden" name="upgrade1Price" value="{{ $cart->upgrade1Price }}">
          <input type="hidden" name="upgrade2Price" value="{{ $cart->upgrade2Price }}">
          <input type="hidden" name="upgrade3Price" value="{{ $cart->upgrade3Price }}">


          <input type="hidden" name="package1Price" value="{{ $cart->package1Price }}">
          <input type="hidden" name="package2Price" value="{{ $cart->package2Price }}">
          <input type="hidden" name="package3Price" value="{{ $cart->package3Price }}">


          <input type="hidden" name="paid" value="{{ 0 }}">
          <input type="hidden" name="payment_method" value="Stripe">






          <div class="col" style="text-align: left;">
            <label class="align-left" style="font-weight: bold; padding-bottom: 15px;">Check in date: {{ $cart->checkInDate }}</label>
            <br>
            <label class="align-left mt-3" id="noOfNightsRangeLabel" style="font-weight: bold; padding-bottom: 15px;">No. of Nights: {{ $cart->numNights }}</label>


          </div>
          <tbody>
            <tr>
              <td>{{ $cart->roomType }}</td>
              <td>
                <ul id="divLeft">
                  <label><strong>Custom Options</strong></label>
                  <li><input class="form-check-input me-2" type="checkbox" value="{{ $cart->feat1Price }}" id="feat1" name="feat1">{{ $cart->feat1 }} +£{{ $cart->feat1Price }}</li>
                  <li><input class="form-check-input me-2" type="checkbox" value="{{ $cart->feat2Price }}" id="feat2" name="feat2">{{ $cart->feat2 }} +£{{ $cart->feat2Price }}</li>
                  <li><input class="form-check-input me-2" type="checkbox" value="{{ $cart->feat3Price }}" id="feat3" name="feat3">{{ $cart->feat3 }} +£{{ $cart->feat3Price }}</li>
                  <li><input class="form-check-input me-2" type="checkbox" value="{{ $cart->feat4Price }}" id="feat4" name="feat4">{{ $cart->feat4 }} +£{{ $cart->feat4Price }}</li>

                  <label><strong>Package Options</strong></label>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="noPackage" name="packageTotal" value="{{ 0 }}" onchange="updateSelectedPackage('None')" checked>
                    <input type="hidden" name="selectedPackage" id="selectedPackage" value="None">
                    <label class="form-check-label" for="noPackage">
                      None
                    </label>
                  </div>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="package1" name="packageTotal" value="{{ $cart->package1Price }}" onchange="updateSelectedPackage('{{ $cart->package1 }}')">


                    <label class="form-check-label" for="package1">
                      {{ $cart->package1 }} +£{{ $cart->package1Price }}
                    </label>
                  </div>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="package2" name="packageTotal" value="{{ $cart->package2Price }}" onchange="updateSelectedPackage('{{ $cart->package2 }}')">

                    <label class="form-check-label" for="package2">
                      {{ $cart->package2 }} +£{{ $cart->package2Price }}
                    </label>
                  </div>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="package3" name="packageTotal" value="{{ $cart->package3Price }}" onchange="updateSelectedPackage('{{ $cart->package3 }}')">

                    <label class="form-check-label" for="package3">
                      {{ $cart->package3 }} +£{{ $cart->package3Price }}
                    </label>
                  </div>



                  <label><strong>Upgrade Options</strong></label>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="noUpgrade" name="upgradeTotal" value="{{ 0 }}" onchange="updateSelectedUpgrade('None')" checked>
                    <input type="hidden" name="selectedUpgrade" id="selectedUpgrade" value="None">
                    <label class="form-check-label" for="noUpgrade">
                      None
                    </label>
                  </div>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="upgrade1" name="upgradeTotal" value="{{ $cart->upgrade1Price }}" onchange="updateSelectedUpgrade('{{ $cart->upgrade1 }}')">

                    <label class="form-check-label" for="upgrade1">
                      {{ $cart->upgrade1 }} +£{{ $cart->upgrade1Price }}
                    </label>

                  </div>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="upgrade2" name="upgradeTotal" value="{{ $cart->upgrade2Price }}" onchange="updateSelectedUpgrade('{{ $cart->upgrade2 }}')">

                    <label class="form-check-label" for="upgrade2">
                      {{ $cart->upgrade2 }} +£{{ $cart->upgrade2Price }}
                    </label>
                  </div>
                  <div class="form-check" id="divLeft">
                    <input class="form-check-input" type="radio" id="upgrade3" name="upgradeTotal" value="{{ $cart->upgrade3Price }}" onchange="updateSelectedUpgrade('{{ $cart->upgrade3 }}')">

                    <label class="form-check-label" for="upgrade3">
                      {{ $cart->upgrade3 }} +£{{ $cart->upgrade3Price }}
                    </label>
                  </div>
                </ul>
              </td>
              <td>£{{ $cart->price }}</td>

            </tr>
          </tbody>

        </table>


    </div>
    <div class="mt-3 text-center">
      <h2>Your hotel room cost: £<span id="hotelCost">0</span></h2>
      <h2>Your total extras cost: £<span id="extrasCost">0</span></h2>
      <h2>Your total costs: £<span id="totalCost">0</span></span></h2>
      <!-- Button trigger modal -->
      <button class="btn btn-primary my-3 me-2" type="submit">Add Extras</button>
      <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#deleteModal{{ $cart->id }}">
        Cancel Booking
      </button>



    </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal{{ $cart->id  }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to cancel this booking?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Deleting is permanent and cannot be undone</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form method="POST" action="{{ route('delete.cart', $cart->id) }}">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit">Cancel Booking</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<script>
  let hotelCost = parseFloat('{{ $cart->price }}');
  let noOfNights = parseFloat('{{ $cart->numNights }}');
  let customCosts = 0;
  let packageCosts = 0;
  let upgradeCosts = 0;
  let totalCost = 0;
  let extrasCost = customCosts + packageCosts + upgradeCosts;
  let upgradeRadioButtons = document.querySelectorAll('input[name="upgradeTotal"]');
  let packageRadioButtons = document.querySelectorAll('input[name="packageTotal"]');
  let checkboxInputs = document.querySelectorAll('input[type="checkbox"]');



  checkboxInputs.forEach(function(checkbox) {
    if (checkbox.checked) {
      customCosts = parseFloat(checkbox.value);

    }
    checkbox.addEventListener('change', function() {
      updateCheckboxValue(checkbox);
      calculateExtrasCosts();
      calculateTotalCost();
      updateCostsInHTML(hotelCost, extrasCost, totalCost);
    });
  });

  function updateCheckboxValue(checkbox) {
    const featNumber = parseInt(checkbox.dataset.featNumber);
    const featPrice = parseFloat(checkbox.value);

    if (checkbox.checked) {
      customCosts += featPrice;

    } else {
      customCosts -= featPrice;

    }
    return customCosts;

  }

  packageRadioButtons.forEach(function(radioButton) {
    if (radioButton.checked) {
      packageCosts = parseFloat(radioButton.value);
    }
    radioButton.addEventListener('change', function() {
      packageCosts = parseFloat(radioButton.value);
      calculateExtrasCosts();
      calculateTotalCost();
      updateCostsInHTML(hotelCost, extrasCost, totalCost);
    });
  });

  upgradeRadioButtons.forEach(function(radioButton) {
    if (radioButton.checked) {
      upgradeCosts = parseFloat(radioButton.value);
    }
    radioButton.addEventListener('change', function() {
      upgradeCosts = parseFloat(this.value);
      calculateExtrasCosts();
      calculateTotalCost();
      updateCostsInHTML(hotelCost, extrasCost, totalCost);
    });
  });


  function calculateHotelCosts() {
    hotelCost = hotelCost * noOfNights;
    return hotelCost;
  }

  function calculateExtrasCosts() {
    extrasCost = (upgradeCosts + packageCosts + customCosts) * noOfNights;
    return extrasCost;

  }

  function calculateTotalCost() {
    totalCost = (hotelCost + extrasCost);
    return totalCost;
  }

  function updateCheckboxValue(checkbox) {
    const featNumber = parseInt(checkbox.dataset.featNumber);
    const featPrice = parseFloat(checkbox.value);

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

  function onPageLoad() {
    // Calculate the three totals when page loads
    calculateHotelCosts();
    calculateTotalCost();
    updateCostsInHTML(hotelCost, extrasCost, totalCost);
  }

  function updateSelectedPackage(packageName) {
    // Update the hidden field value when the radio button is checked
    document.getElementById('selectedPackage').value = packageName;
    console.log(packageName);
  }

  function updateSelectedUpgrade(upgradeName) {
    document.getElementById('selectedUpgrade').value = upgradeName;
    console.log(upgradeName);
  }


  window.onload = onPageLoad;
</script>


@endsection