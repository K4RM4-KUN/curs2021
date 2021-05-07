<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas</title>
</head>
<body>
    <div style="margin-bottom:1rem;">

        <a style="text-decoration:none;" href="{{url('listas/following')}}">

            <button>Siguiendo {{$followers}}</button>

        </a>

        <a style="text-decoration:none;" href="{{url('listas/pending')}}">

            <button>Pendientes {{$pending}}</button>

        </a>

        <a style="text-decoration:none;" href="{{url('listas/readed')}}">

            <button>Leidas {{$readed}}</button>

        </a>

        <a style="text-decoration:none;" href="{{url('listas/favorite')}}">

            <button>Favoritas {{$favorite}}</button>

        </a>

        <a style="text-decoration:none;" href="{{url('listas/abandoned')}}">

            <button>Abandoandas {{$abandoned}}</button>

        </a>


    </div>
    <div>
        <table border="1">
            <tr><th>name</th><th>capitulos</th><th>read</th></tr>
            @foreach($novels as $novel)
                <tr>
                    <td>{{$novel->name}}</td>
                    <!-- <td>@{{$novel->LeidosPorElUsuario}}/{{$novel->chapters_count}}</td> -->
                    <td>@foreach($lastViews as $lastView) @if($lastView->novel_id == $novel->id)<?$x=0;?>{{$lastView->chapter_n}}@endif @endforeach @if(!isset($x)) 0 @endif/ {{$novel->chapters_count}}</td>
                    <td><a href="{{url('novel/'.$novel->id)}}"><button>READ</button></a></td>
                </tr>
            @endforeach
        </table>
    </div>
    
</body>
</html>