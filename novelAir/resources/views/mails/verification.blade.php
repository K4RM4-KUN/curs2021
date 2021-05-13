<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <h2>Solicitud de verificación</h2> 
    <img width="25%" src="@if(empty($user['imgtype'])) {{asset('images/noimage.png')}} @else {{asset('users/'.$user['id'].'/profile/usericon'.$user['imgtype'])}} @endif" alt="">
    <p>Name: <b>{{$data['names']}}</b></p> 
    <p>Num ID: <b>{{$data['numId']}}</b></p> 
    <p>Username: <b>{{$user['username']}}</b></p> 
    <p>ID: <b>{{$user['id']}}</b></p>
    <p>Enviado: <b>{{date('d-m-Y')}}</b></p>
    
</body>
</html>