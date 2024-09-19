@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url("{{ asset('images/pattern.png') }}");
        }
    </style>
    <!-- Page Content -->
    <div class="container">


        <!-- Header -->
        <header class="w3-container w3-center" style="padding:30px 16px" id="home">
            <h2 class='yellow_text mb-4'>Šapica - Pametni Tag!</h2>
            <p class="" style="text-align: justify">
                Ocitavanje web stranice sa svim informacijama vlasnika kao i zalutale sape, moguce je putem NFC-a, kao i
                skeniranjem QR koda.
                Prislanjanjem taga na telefon koji podrzava NFC tehnologiju ili skeniranjem QR koda koji se nalazi na
                poledjini taga, pristupicete web stranici koja sadrzi informacije o vlasniku i zalutalom ljubimcu.
                Obavestite vlasnika o Vasoj lokaciji ili pozovite i pomozite da se ljubimac vrati u svoj dom!
            </p>
            <button class="w3-button w3-light-grey w3-padding-large w3-margin-top ">
                <i class="fa fa-shopping-cart yellow_text" aria-hidden="true"></i><a class="nav-link"
                    href="{{ route('products.list') }}"> Kupi</a>
            </button>
        </header>

        <!-- Portfolio Section -->
        <div class="w3-padding-32 w3-content" id="portfolio">
            <h2 class="yellow_text mb-3 text-center">Šape</h2>

            <!-- Grid for photos -->
            <div class="w3-row-padding" style="margin:0 -16px">
                <div class="w3-half">
                    <img src="{{ asset('images/dog.jpg') }}" style="width:100%">
                    <img src="{{ asset('images/small.jpg') }}" style="width:100%">
                    <img src="{{ asset('images/blue.jpg') }}" style="width:100%">
                </div>

                <div class="w3-half">
                    <img src="{{ asset('images/russian.jpg') }}" style="width:100%">
                    <img src="{{ asset('images/black.jpg') }}" style="width:100%">
                    <img src="{{ asset('images/yellow.jpg') }}" style="width:100%">

                </div>
                <!-- End photo grid -->
            </div>
            <!-- End Portfolio Section -->
        </div>

        <!-- About Section -->
        <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="about">


            <div class="w3-row w3-center w3-dark-grey w3-padding-16 w3-section yellow_background">
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">95.6%</span><br>
                    Genetskog koda kućne mačke dele sa tigrom
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">48 km/h</span><br>
                    Maksimalna izmerena brzina mačke
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">12-16h</span><br>
                    Mačke dremaju u toku dana
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">25-150 hertz</span><br>
                    Frekvencija Mačjeg predenja
                </div>
            </div>

            <div class="w3-row w3-center w3-dark-grey w3-padding-16 w3-section yellow_background">
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">40x</span><br>
                    Psi imaju bolji njuh od čoveka
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">72 km/h</span><br>
                    Maksimalna izmerena brzina pasa
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">18</span><br>
                    Mišića kontroliše pseće oči
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">165</span><br>
                    Reči može da razume prosečan pas
                </div>
            </div>

        </div>

        <!-- Contact Section -->
        <div class="w3-padding-32 w3-content w3-text-grey" id="contact">
            <h2 class="yellow_text">Kontakt</h2>

            <form action="{{ route('questions') }}" method="POST">
                @csrf
                <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Ime" required name="name">
                </p>
                <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Email" required
                        name="email"></p>
                <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Naslov" required
                        name="subject"></p>
                <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Poruka" required
                        name="message"></p>
                <p>
                    <button class="w3-button w3-light-grey w3-padding-large" type="submit">
                        <i class="fa fa-paper-plane yellow_text"></i> Pošalji Poruku
                    </button>
                </p>
            </form>
            <!-- End Contact Section -->
        </div>

        <!-- Footer -->
        <footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-opacity w3-xlarge mx-3" >
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>

        </footer>

        <!-- END PAGE CONTENT -->
    </div>

    <script>
        // Open and close sidebar
        function openNav() {
            document.getElementById("mySidebar").style.width = "60%";
            document.getElementById("mySidebar").style.display = "block";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.display = "none";
        }
    </script>
@endsection
