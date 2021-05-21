<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovelAir</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        html{
            height:100%;
            background-image: linear-gradient(to bottom right, #616161, #212121);
            background-repeat: no-repeat;
        }
        .argument{
            width: 60%;
            margin: 20% auto;
            background-color:white;
            padding: 20px 50px;
            border-radius: 25px;
        }
        img{
            width:200px;
            margin: 0 auto;
        }
    </style>
</head>
    <body>
        <div class="argument">
            <center><img src="http://dawjavi.insjoaquimmir.cat/jfuentes/novelAir/public/images/logo2.png" alt="logo"></center>
            <p>Email: <b>{{$data['email']}}</b></p> 
            <p>Asunto: <b>{{$data['message']}}</b></p>
        </div>
    </body>
</html>