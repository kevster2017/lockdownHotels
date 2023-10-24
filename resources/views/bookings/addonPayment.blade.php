@extends('layouts.app')

@section('content')


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