<!DOCTYPE html>
<html>
<head>
    <title>Pametne Sape Notifikacija</title>
</head>
<body>
    <p>{{ $mailData->title }}</p>
    <br>
    <p>{{ $mailData->body }}</p>
    <img style="width: 250px !important;height: 250px;border-radius: 50%;" src="{{ $message->embed( public_path().'/images/'.$pet->image->url ) }}">
    

     <br>
     <p>Hvala, Vaš {{ $pet->name }}</p>
</body>
</html>