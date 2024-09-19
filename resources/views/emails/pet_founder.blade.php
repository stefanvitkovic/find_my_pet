<!DOCTYPE html>
<html>
<head>
    <title>Pametne Sape Notifikacija</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <p>Kontaktirajte pronalazaca na sledeci broj: </p>

    <p>{{ $mailData['founder_phone'] }}
     
    <p>Srecno!</p>
</body>
</html>