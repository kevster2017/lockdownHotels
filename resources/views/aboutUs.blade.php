@extends('layouts.app')

@section('content')

<!--Breadcrumb-->

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>
</div>
<!--Main container for background-->
<div class="bg">
    <div class="container">
        <div class="row">

            <!--Page content-->
            <div class="container">
                <div class="row">
                    <div class="about-us-image">

                        <p>
                            <a href="https://www.nationaltrust.org.uk/giants-causeway" target="_blank"><img src="Images/GiantsCauseway.jpg" alt="Giants Causeway Image"></a>
                        </p>
                    </div>

                    <h1>About Us</h1>
                    </br>

                </div>

                <div class="who-are-we">
                    <div class="row mx-n2 m-0">
                        <div class="region region_landscape-small col-12 col-md-6 px-2"><br>
                            <h3>Who are we</h3><br>
                            <p>Established in 2021, Lockdown Hotels was created by four Ulster University students who were keen on a holiday, but were unable to do so due to the Covid-19 Pandemic. </p>
                        </div>
                        <div class="region region_landscape-small col-12 col-md-6 px-2"><br>
                            <p>
                                <a href="https://titanicbelfast.com/" target="_blank"><img src="Images/Titanic.jpg" alt="Titanic Buidling Image" width="420" height="315"></a>
                            </p>
                            <p><small>Titanic Exhibition Centre, Belfast</small></p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="our-aim">
                    <div class="row mx-n2 m-0">
                        <div class="region region_landscape-small col-12 col-md-6 px-2 overflow-auto"><br>
                            <p>
                                <a href="https://thetemplebarpub.com/" target="_blank"><img src="Images/TempleBar.jpg" alt="Temple Bar Image" width="420" height="315" class="img-responsive"></a>
                            </p>
                            <p><small>The Temple Bar, Dublin</small></p>
                        </div>
                        <div class="region region_landscape-small col-12 col-md-6 px-2">
                            <br>
                            <h3>Our aim</h3><br>
                            <p>As flights were cancelled and countries closed their borders, the local tourism industry was decimated. This led to businesses such as bars, shops and restaurants having to close their doors, some of which for good</p>
                            <p> Our aim is to provide a much needed boost the local tourist industry and support local businesses whilst keeping in line with current government restrictions</p>
                            </p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="our-purpose">
                    <div class="row mx-n2 m-0">
                        <div class="region region_landscape-small col-12 col-md-6 px-2"><br>
                            <h3>Our Purpose</h3><br>
                            <p>Our website offer hoteliers and landlords a way to advertise their properties and help to minimise costs, improve efficiency and enhance the customer experience. We aim to attract local tourists of all ages, backgrounds
                                and beliefs by providing a facility to book the type of break that suits their needs and to help kick-start the local economy. . </p>
                        </div>
                        <div class="region region_landscape-small col-12 col-md-6 px-2">
                            <p>
                                <a href="https://www.croagh-patrick.com/" target="_blank"><img src="Images/CroaghPatrick.jpg" alt="Croagh Patrick Image" width="420" height="315"></a>
                            </p>
                            <p><small>Croagh Patrick, Teevenacroaghy, Co. Mayo</small></p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="our-mission">
                    <div class="row mx-n2 m-0">
                        <div class="region region_landscape-small col-12 col-md-6 px-2 overflow-auto"><br>
                            <p><iframe width="420" height="315" src="https://www.youtube.com/embed/L3OBlbOF30E">
                                </iframe> </p>
                        </div>
                        <div class="region region_landscape-small col-12 col-md-6 px-2">
                            <br>
                            <h3>Our Mission</h3><br>
                            <p>Our mission is to be able to welcome tourists from all over the world when the Covid-19 restrictions are lifted, enabling the site to increase its target audience and providing nothing but the best holidays in Ireland</p>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!--Closing Divs for main container-->
        </div>
    </div>
</div>
@endsection