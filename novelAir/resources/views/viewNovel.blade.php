<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('goNM')}}"><button>BACK</button></a>
    <divs style="display:flex;">
        <div style="margin-right: 150px;">
            <form action="{{route('editNovel')}}" method="POST">
            @csrf
                <input type="text" hidden name="id" value="{{$novels[0]->id}}"><br><br>
                <label for="name">Nombre:</label><br>
                <input type="text" name="name" value="{{$novels[0]->name}}"><br><br>
                <label for="genre">Genero:</label><br>
                <input type="text" name="genre" value="{{$novels[0]->genre}}"><br><br>
                <label for="sinopsis">Sinopsis:</label><br>
                <input type="text" name="sinopsis" value="{{$novels[0]->sinopsis}}"><br><br>
                <input type="submit">
            </form>
        </div>
        <div>
        <table border="1px">
            <tr>
                <th>Number</th>
                <th>Nombre</th>
                <th>Views</th>
            </tr>
            @foreach ($chapters as $chapter)
            <tr>
                <td>
                    {{ $chapter->chapter_n }}
                </td>
                <td>
                    <a href="#">{{ $chapter->title }}</a>
                </td>
                <td>
                    3
                </td>
            </tr>
            @endforeach
    </table>
    <a href="{{url('novel_manager')}}/{{$novels[0]->id}}/add_chapter"><button>Crear capitulo</button></a>
        </div>
    </div>
</body>
</html>