<!DOCTYPE html>
<html>
<head>
    <title>Pametne Sape Notifikacija</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <p>Mozete videti lokaciju na mapi: </p>

    <a href={{ "https://www.google.com/maps/search/?api=1&query=".$mailData['lat'].",".$mailData['long']."" }}>Mapa</a>

    <p>Koordinate : {{ $mailData['lat'] }} : {{ $mailData['long'] }}</p>
     
    <p>Srecno!</p>
</body>
</html>