<!DOCTYPE html>
<html>
<head>
    <title>Smart Paws Notification</title>
</head>
<body>
<div class="container">
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <div class="row m-0" id="">

        <h2>Narucena su: <b>{{ $mailData['data']['quantity'] }}</b> taga</h2>
        

    </div>

    <div class="row">

        <ul>

            <li>Ime: {{ $mailData['data']['name'] }}</li>
            <li>Prezime: {{ $mailData['data']['last_name'] }}</li>
            <li>Telefon: {{ $mailData['data']['phone'] }}</li>
            <li>Email: {{ $mailData['data']['email'] }}</li>

            <li>Adresa: {{ $mailData['data']['address'] }}</li>
            <li>Grad: {{ $mailData['data']['city'] }}</li>
            <li>Postanski Broj: {{ $mailData['data']['postcode'] }}</li>
            <li>Dodatno: {{ $mailData['data']['note'] }}</li>

            <li>Ime ljubimca: {{ $mailData['data']['pet_name'] }}</li>
            <li>Tip: {{ $mailData['data']['type'] }}</li>

        </ul>

    </div>

    
     
</div>
</body>