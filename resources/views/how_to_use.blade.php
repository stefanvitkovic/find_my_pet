@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url("{{ asset('images/pattern.png') }}");
        }
    </style>
    <!-- Page Content -->
    <div class="container">

        <div class="w3-padding-32 w3-content">
            <h2 class="yellow_text mb-3 text-center">NFC - Korak po korak</h2>


            <!-- Grid for photos -->
            <div class="w3-row-padding" style="margin:0 -16px">
                <div class="w3-half">
                    <b>
                        <p class="text-secondary">1) Uključite NFC u postavkama uređaja</p>
                    </b>
                    <img src="{{ asset('images/nfc_on.jpg') }}" style="width:100%">
                </div>
                <div class="w3-half">
                    <b>
                        <p class="text-secondary">2) Približite uređaj NFC tagu</p>
                    </b>
                    <img src="{{ asset('images/nfc_tap.jpg') }}" style="width:100%">
                </div>

            </div>
        </div>

        <hr>

        <div class="w3-padding-32 w3-content">
            <h2 class="yellow_text mb-3 text-center">QR - Korak po korak</h2>


            <!-- Grid for photos -->
            <div class="w3-row-padding" style="margin:0 -16px">
                <div class="w3-half">
                    <b>
                        <p class="text-secondary">1) Otvorite kameru</p>
                    </b>
                    <img src="{{ asset('images/camera.jpg') }}" style="width:100%">
                </div>
                <div class="w3-half">
                    <b>
                        <p class="text-secondary">2) Skenirajte QR kod i otvorite ponuđeni link</p>
                    </b>
                    <img src="{{ asset('images/scan.jpg') }}" style="width:100%">
                </div>

            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
@endsection
