@extends('layouts.app')

@section('content')
<!--Breadcrumb-->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ route('bookings.create') }}">Booking Page</a></li>
        <li>Payment</li>
    </ul>
</div>

<div class="row">

    <!--Booking details display-->
    <div class="price text-align: center">
        <p> Your total is <b><span id="result2"></span></b></p><br><br>
        <script>
            document.getElementById("result2").innerHTML = formatter2DecimalPlaces.format(localStorage.getItem("addonPrice"));
        </script>

        <!-- Card Icons-->
        <div class="cards">
            <p>Click your method of payment below</p>
            <button class="button visa" data-toggle="tooltip" title="Click here to pay by Visa Debit or Credit Card"><img src="/images/CCards/VisaMedium.png" alt="Visa button" onclick="enableCardFields()"></button>
            <button data-toggle="tooltip" title="Click here to pay by MasterCard Debit or Credit Card"><img src="/images/CCArds/MasterCardMedium.png" onclick="enableCardFields()" alt="MasterCard button"></button>
            <button><a href="https://www.paypal.com/uk/signin" title="By clicking PayPal, you will be redirected to the PayPal website for payment. When you have completed your payment through PayPal, click the pay now button to confirm your booking" target="_blank" onclick="enablePayNow()"><img src="/images/CCArds/PayPalMedium.png" alt="PayPal button"></a></button><br><br>


            <!-- Form input -->
            <form action="#" id="form" class="was-validated" onkeyup="manage()" novalidate>
                <div class="col-md-6 offset-md-3">
                    <label for="bookingnum" class="form-label">Booking Number</label>
                    <input type="bookingnum" class="form-control" id="bookingnum" required minlength="10" maxlength="50" disabled="disabled">
                </div>

                <div class="col-md-6 offset-md-3">
                    <label for="NameInput" class="form-label">Name on Card</label>
                    <input type="text" class="form-control" id="NameInput" placeholder="Joe Bloggs" required minlength="3" maxlength="40" disabled="disabled">
                    <div class="invalid-feedback">Enter your name</div><br>
                </div>


                <div class="col-md-6 offset-md-3">
                    <label for="CardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="CardNumber" placeholder="Card Number" required pattern="[0-9]+" minlength="16" maxlength="16" disabled="disabled">
                    <div class="invalid-feedback">Enter a valid card number (No Spaces)</div><br>
                </div>

                <div class="row">
                    <div class="col-md-2 offset-md-3">
                        <label for="CardExpiry" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="CardExpiry" placeholder="MMYY" pattern="[0-9]+" required minlength="4" maxlength="4" disabled="disabled">
                        <div class="invalid-feedback">Enter a valid card expiry date in the format MMYY (No
                            Spaces)
                        </div><br>
                    </div>

                    <div class="col-md-2">
                        <label for="SecurityCode" class="form-label">Security Code</label>
                        <input type="text" class="form-control" id="SecurityCode" placeholder="CVC" required minlength="3" maxlength="3" pattern="(.)[0-9]+" disabled="disabled">
                        <div class="invalid-feedback">3 digit security code required
                        </div><br>
                    </div>

                    <div class="col-md-2">
                        <label for="Postcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" id="Postcode" placeholder="Postcode" required minlength="6" maxlength="8" pattern="[a-zA-Z0-9]+" disabled="disabled">
                        <div class="invalid-feedback">Please enter a valid postcode (No Spaces)</div><br>
                    </div><br>
                </div>

                <div class="col-md-6 offset-md-3">
                    <input type="checkbox" class="form-check-input" id="SaveCard">
                    <label class="form-check-label" for="SaveCard">Save card for future reference</label>
                </div>

            </form><br>

            <!-- Go Back and pay now buttons -->
            <button class="w-40 btn btn-danger btn-md" type="submit" onclick="document.location='BookingPage.html'">Go Back</button>
            <button id="payNow" class="w-40 btn btn-success btn-md" type="submit" onclick="update()" disabled="disabled">Pay Now</button>

            <br><br>
        </div>
    </div>
</div>


<!--Script to enable Pay Now button-->
<script>
    function enablePayNow() {
        document.getElementById("payNow").disabled = false;
    }
</script>

<!--Script to enable card fields when Visa/MasterCard button clicked-->
<script>
    function enableCardFields() {
        document.getElementById("bookingnum").disabled = false;
        document.getElementById("NameInput").disabled = false;
        document.getElementById("CardNumber").disabled = false;
        document.getElementById("CardExpiry").disabled = false;
        document.getElementById("SecurityCode").disabled = false;
        document.getElementById("Postcode").disabled = false;
    }
</script>

<script>
    const formatter2DecimalPlaces = new Intl.NumberFormat('en-UK', {
        style: 'currency',
        currency: 'GBP',
        minimumFractionDigits: 2
    });
</script>

<!--Script to enable Pay Now button after validating form-->
<script>
    function manage(txt) {
        var bt = document.getElementById('payNow');
        var ele = document.getElementsByTagName('input');

        // Loop through each element.
        for (i = 0; i < ele.length; i++) {

            // Check the element type
            if (ele[0].checkValidity() == true && ele[1].checkValidity() == true &&
                ele[2].checkValidity() == true && ele[3].checkValidity() == true &&
                ele[4].checkValidity() == true && ele[5].checkValidity() == true) {
                bt.disabled = false;
            } else {
                bt.disabled = true;
            }
        }
    }

    function update() {
        alert('Successfully added');
    }
</script>


@endsection