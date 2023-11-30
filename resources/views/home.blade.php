@extends('layouts.app')

@section('content')


<!--Main container for background-->




<div class="cookie-website-banner">
    <div class="cookie_container">
        <p>This website uses Cookies. By continuing to use the website you consent to the cookies in use.</p>
        <button class="btn1">Accept</button>
    </div>
</div>


<div class="row">

    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/Titanic_belfastHD.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Titanic Quarter - Belfast</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="Images/Giants_CausewayHD.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Giant's Causway - North Coast</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="Images/Temple_BarHD.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Temple Bar - Dublin</h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



</div>

<div class="container-fluid">
    <!-- Options below carousel -->
    <div class="row pt-3">

        <div class="col-sm-6 text-center">
            <img src="Images/Titanic_Circle.png" alt="Titanic" style="width:250px; height:250px; padding-top:25px">
            <h2>City Break</h2>

            <p><a class="btn btn-primary" href="{{ route('hotels.city') }}">View details &raquo;</a></p>
        </div>



        <div class="col-sm-6 text-center">
            <img src="Images/Causeway_Circle.png" alt="Causeway" style="width:250px; height:250px; padding-top:25px">
            <h2>Seaside Resort</h2>

            <p><a class="btn btn-primary" href="{{ route('hotels.seaside') }}">View details &raquo;</a></p>
        </div>




    </div>
</div>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-sm-6 text-center">
            <img src="Images/Country_Circle.png" alt="Country" style="width:250px; height:250px; padding-top:25px">
            <h2>Country Escape</h2>

            <p><a class="btn btn-primary" href="{{ route('hotels.country') }}">View details &raquo;</a></p>
        </div>

        <div class="col-sm-6 text-center">
            <img src="Images/Country_Circle.png" alt="Country" style="width:250px; height:250px; padding-top:25px">
            <h2>All Hotels</h2>

            <p><a class="btn btn-primary" href="{{ route('hotels.index') }}">View details &raquo;</a></p>
        </div>
    </div>

</div>





<script>
    $(document).ready(function() {
        $(".btn1").click(function() {
            $(".cookie_container").hide("slow", "linear");
        });
    });
</script>
@endsection