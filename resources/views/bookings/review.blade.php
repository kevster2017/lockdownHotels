@extends('layouts.app')

@section('content')


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/hotels/show/{{ $cart->hotel_Id }}">Hotel</a></li>
            <li class="breadcrumb-item"><a href="/bookings/viewCart">View Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Booking Review</li>
        </ol>
    </nav>
</div>

<div class="container text-center my-5">
    <h1>Review Booking at {{ $cart->name }}</h1>
</div>

<div class="container mt-3">
    <div class="card text-bg-light mb-3" style="max-width: 1080px;">
        <div class="row g-0">
            <div class="col-md-4">


                <img src="/storage/{{ $cart->image }}" class="img-fluid rounded-start" alt="Hotel Image">


            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title" id="divLeft">{{ $cart->name }}</h5>
                    <p class="card-text" id="divLeft">{{ $cart->address }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->town }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->country }}</p>
                    <p class="card-text" id="divLeft">{{ $cart->postCode }}</p>

                    <p class="card-text"><small class="text-body-secondary">Booking Created: {{ $cart->created_at }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card text-bg-light">
        <h5 class="card-header" id="divLeft">Booking Details</h5>
        <div class="card-body">
            <p class="card-text" id="divLeft"> {{ $cart->roomType }} room</p>
            <p class="card-text" id="divLeft">Check in: {{ $cart->checkInDate }}</p>
            <p class="card-text" id="divLeft"> {{ $cart->numNights }} nights</p>
            <p class="card-text" id="divLeft"><strong>Hotel Price: £{{ $cart->price }}</strong></p>
        </div>
    </div>
</div>

<div class="container mt-3">

    <div class="card text-bg-light">
        <h5 class="card-header" id="divLeft">Features Details</h5>
        <div class="card-body">
            @if($cart->selectedFeat1 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat1 }}, £{{ $cart->feat1Price}} per night</p>
            @endif
            @if($cart->selectedFeat2 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat2 }}, £{{ $cart->feat2Price}} per night</p>
            @endif
            @if($cart->selectedFeat3 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat3 }}, £{{ $cart->feat3Price}} per night</p>
            @endif
            @if($cart->selectedFeat4 != "None")
            <p class="card-text" id="divLeft">Feature: {{ $cart->feat4 }}, £{{ $cart->feat4Price}} per night</p>
            @endif
            @if($cart->featuresTotal != 0)
            <p class="card-text" id="divLeft"><strong>Features Total: £{{ $cart->featuresTotal }}</strong></p>
            @else
            <p class="card-text" id="divLeft"><strong>{{ "No extras added" }}</strong></p>
            @endif
        </div>
    </div>

    <div class="card text-bg-light mt-3">
        <h5 class="card-header" id="divLeft">Upgrade Details</h5>
        <div class="card-body">
            @if($cart->upgradeTotal == 0)
            <p class="card-text" id="divLeft"><strong>{{ "No upgrade added" }}</strong></p>
            @else

            <p class="card-text" id="divLeft">Upgrade: {{ $cart->selectedUpgrade }}</p>
            <p class="card-text" id="divLeft"><strong>Total Upgrade Price: £{{ $cart->upgradeTotal }}</strong></p>

            @endif

        </div>
    </div>

    <div class="card text-bg-light mt-3">
        <h5 class="card-header" id="divLeft">Package Details</h5>
        <div class="card-body">
            @if($cart->packageTotal == 0)
            <p class="card-text" id="divLeft"><strong>{{ "No package added" }}</strong></p>
            @else
            <p class="card-text" id="divLeft">Package: {{ $cart->selectedPackage }}</p>
            <p class="card-text" id="divLeft"><strong>Total Package Price: £{{ $cart->packageTotal }}</strong></p>
            @endif

        </div>
    </div>

    <div class="card text-bg-light mt-3">
        <h5 class="card-header" id="divLeft">Final Total</h5>
        <div class="card-body">
            <h3 class="text-center"><strong>Final Total: £</strong>{{ $cart->finalTotal}}</h3>
        </div>
    </div>


    <div class="card text-bg-light mt-3">
        <h5 class="card-header" id="divLeft">Choose your method of payment</h5>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="stripe" onchange="paymentMethod('Stripe')" checked>
                        <label class="form-check-label" for="stripe">
                            Stripe Payment
                        </label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="paypal" onchange="paymentMethod('PayPal')">
                        <label class="form-check-label" for="paypal">
                            PayPal
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container text-center">
        <a href="{{ route('bookings.stripe') }}" class="btn btn-primary" id="paymentButton">Book Now</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $cart->id }}" id="cancelBookButton">
            Cancel Booking
        </button>
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
    let paymentRadioButtons = document.querySelectorAll('input[name="payment"]');
    let paymentButton = document.getElementById('paymentButton');

    paymentRadioButtons.forEach(function(radioButton) {

        radioButton.addEventListener('change', function() {
            if (radioButton.id === 'stripe' && radioButton.checked) {
                paymentButton.href = "{{ route('bookings.stripe') }}";
            } else if (radioButton.id === 'paypal' && radioButton.checked) {
                paymentButton.href = "{{ route('bookings.paypal') }}";
            }
        })
    });
</script>


@endsection