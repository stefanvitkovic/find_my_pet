@extends('layouts.app')

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12 text-center col col-sm-12 col-xs-12 ">
                            <div class="form-group">
                                    <img class="rounded-circle shadow-lg p-1 bg-body rounded float-left m-2" style="width: 250px !important;height: 250px !important; object-fit: cover;object-position: 100% 0;" alt="avatar2" src="{{ asset('images/sapa.png') }}" />

                                <br>

                                <div id="note" class="text-center m-3">
                                    {{-- <i> --}}
                                        Pozdrav! Ovo je Šapica - Pametni Tag!
                                        <br>
                                        <br>
                                        Ocitavanje web stranice sa svim informacijama vlasnika kao i zalutale sape, 
                                        moguce je putem NFC-a, kao i skeniranjem QR koda.
                                        <br>
                                        Prislanjanjem taga na telefon koji podrzava NFC tehnologiju ili 
                                        skeniranjem QR koda koji se nalazi na poledjini taga,  
                                        pristupicete web stranici koja sadrzi informacije o vlasniku i zalutalom ljubimcu.
                                        <br>
                                        Obavestite vlasnika o Vasoj lokaciji ili pozovite i pomozite da se ljubimac vrati u svoj dom!

                                    {{-- </i> --}}
                                </div>
                                <div id="owners_note" class="text-center m-3">
                                    
                                    <i>Ako zelite da Vas sapica tag bude poseban i drugaciji od drugih, 
                                        omogucili smo personalizaciju prednje strane taga:
                                        <br>
                                        Napisite ime Vaseg ljubimca ili Vase ime
                                        <br>
                                        Kontakt telefon
                                        <br>
                                        Kratku poruku
                                        <br>
                                        Izaberite boju                                 
                                        <br>
                                        Sliku/Crtez
                                        <br>
                                        Jer vas krzneni prijatelj zasluzuje najbolje!
                                    </i>
                                </div>
                                <div class="text-start mt-5">
                                    <small>
                                    <i>
                                        * potrebno je ukljuciti NFC u postavkama uredjaja <img src="{{ asset('images/nfc.png') }}"  height="40px" alt="nfc tag">
                                    </i>
                                    </small>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-xs-12 ">
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
