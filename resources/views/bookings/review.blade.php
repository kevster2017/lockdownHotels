@extends('layouts.app')

@section('content')

<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Booking Review</li>
    </ul>
</div>

<div class="container">
    <div class="row">
        <div class="col-5">

            <form name="myForm" action="/action_page.php" onsubmit="return validateForm()" method="post" required>
                <h4>Enter booking details to check or change booking</h4>
                <br>
                <input type="text" name="bookingnum" id="bookingref" placeholder="Booking reference number" class="form-control">
                <p class='rq'>*Required</p>
                <br>
                <input type="text" name="lastname" id="lname" placeholder="Last Name" class="form-control">
                <p class='rq'>*Required</p>
                <input type="submit" value="Submit" class='submit'>
            </form>

            <br>
            <!--Add meal-->
            <div class="accordion" id="accordionAddon" style="visibility: hidden">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <h6>Add a meal</h6>
                        </button>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <h6>3 course evening meal - £52.50 <button class="addon1" type="button" name="meal" onclick="payNow()">+</button>
                                </h6>
                            </div>
                        </div>
                </div>

                <!--Add a day out-->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h6>Add a day package</h6>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h6>Reserve space on tennis court - £30 <button class="addon2" type="button" name="tennis" onclick="payNow1()">+</button>
                            </h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-7">
            <h3>Your details</h3>
            <br>
            <div class="card card-body" id="bookinginfo" style="visibility: hidden">
                <ul>
                    <li>Slieve Commedagh Resort in Newcastle</li>

                    <li>14/04/2021 - 3 nights</li>

                    <li>Double room with Breakfast</li>

                    <li>Spa add on</li>
                </ul>

            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var x = document.forms["myForm"]["bookingnum"].value;
        var y = document.forms["myForm"]["lastname"].value;
        if (x == "" && y == "") {
            alert("Required fields must be filled out");
        } else {
            showinfo()
        }
        return false;
    }

    function showinfo() {
        var z = document.getElementById('bookinginfo');
        var v = document.getElementById('accordionAddon');
        z.style.visibility = 'visible';
        v.style.visibility = 'visible';

    }

    function payNow() {
        var addonPrice = 52.50;

        localStorage.setItem("addonPrice", addonPrice);

        window.location.href = "AddonPaymentPage.html";
    }

    function payNow1() {
        var addonPrice = 30;

        localStorage.setItem("addonPrice", addonPrice);

        window.location.href = "AddonPaymentPage.html";
    }
</script>
@endsection