<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="&quot;Pametne šape&quot; Pametni Tag - Šapica privezak koji se stavlja na ogrlicu vašeg ljubimca. Prislonite tag na poleđinu vašeg telefona i saznajte sve informacije o ljubimcu i njegovom staratelju. Obavestite vlasnika o svojoj lokaciji kako bi pomogli da se izgubljena šapa vrati kući!">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="shortcut icon" href="{{ asset('images/sapa.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/sapa.png') }}">

    <link rel="preload" href="{{ asset('images/pattern.png') }}" as="image"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>

        
        .w3-row-padding img {margin-bottom: 12px}
        .bgimg {
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url("{{ asset('images/dog.jpg') }}");
        min-height: 100%;
        }
        .yellow_text{
        color:#ffdb00 !important;
        text-shadow: #585858 1px 1px 1px;
        }
        .yellow_background{
        background-color:#ffdb00 !important
        }

        html,body,td,div,button,a{
            font-family: "Montserrat", sans-serif,"BwModelica-Medium", Arial, Helvetica, sans-serif;
            font-size: 18px;
            line-height: 32px;

        }

        .navbar{
            background-color: #ffdb00 !important;
        }

        .navbar-nav{
            --bs-nav-link-color:black !important;
        }

        .missing{
            background-color:black;
            color:#ffdb00 !important;
            border-radius:5%;
        }

        .missing:hover{
            color:white !important;
        }

        @keyframes glowing_nav_button {
            0% {
                background-color: rgb(0, 0, 0);
                box-shadow: 0 0 5px rgb(0, 0, 0);
            }
            50% {
                background-color: white;
                box-shadow: 0 0 10px white;
                color:black !important;
            }
            100% {
                background-color: rgb(0, 0, 0);
                box-shadow: 0 0 5px rgb(0, 0, 0);
            }
        }
        .missing_nav_button {
        animation: glowing_nav_button 10300ms infinite;
        }


    </style>
    
</head>
<body style="">
    {{-- <body style="background-image:url({{ asset('images/pattern.png') }}); background-size:auto;"> --}}

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-lignt shadow-sm" style="color:white !important">
            {{-- <nav class="navbar navbar-expand-md navbar-dark bg-black shadow-sm" style="background-image:url({{ asset('images/pattern.png') }}); background-size:auto;"> --}}
    
            <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}" style="padding-bottom: 10px;">
                        <img src="{{ asset('images/sapa.png') }}" alt="" width="30" height="24">
                      </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>


        <main class="py-4 mb-5">
            @yield('content')
        </main>
    </div>

    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</body>
</html>
