<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('dashboard')}}"><button>BACK</button></a>
    <table border="1px">
        <tr>
            <th>Nombre</th>
            <th>Capitulos</th>
            <th>Seguidores</th>
        </tr>
        @foreach ($novels as $novel)
        <tr>
            <td>
                <a href="{{url('novel_manager')}}/{{$novel->id}}">{{ $novel->name }}</a>
            </td>
            <td>
                {{ $novel->chapters_count }}
            </td>
            <td>
                3
            </td>
        </tr>
        @endforeach
    </table>
    <a href="{{route('createNovel')}}"><button>Crear novela</button></a>
</body>
</html>