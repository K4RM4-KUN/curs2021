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
            <form action="{{route('editNovel')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="text" hidden name="id" value="{{$novels[0]->id}}"><br><br>
                <label for="name">Nombre:</label><br>
                <input type="text" name="name" value="{{$novels[0]->name}}"><br><br>
                <label for="cover">Portada(300x450):</label><br>
                <input type="file" name="cover" accept="image/jpg,image/jpeg,image/png"><br><br>
                <label for="genre">Genero:</label><br>
                <input type="text" name="genre" value="{{$novels[0]->genre}}"><br><br>
                <label for="sinopsis">Sinopsis:</label><br>
                <input type="text" name="sinopsis" value="{{$novels[0]->sinopsis}}"><br><br>

                
                <label for="tags">Tags</label><br>
                <input id="tags" type="text" name="tags" 
                value="@foreach($tags as $tag){{strtolower($tag->tag_name)}},@endforeach"
                placeholder="accion,aventura,romance..." /><br><br>

                <input type="checkbox" name="adultContent" id="adultContent" @if ($novels[0]->adult_content) checked @endif>
                <label for="adultContent">+18</label><br><br>

                <input type="checkbox" name="public" id="public" @if ($novels[0]->public) checked @endif>
                <label for="public">Publico</label><br><br>

                <input type="submit">
            </form>
            
            <a href="{{url('novel_manager/delNovel')}}/{{$novels[0]->id}}"><button>ELIMINAR</button></a>
            @if (count($chapters)==0)
                <a href=""><button disabled>No hay capitulos</button></a>
            @else
                <a href="{{url('novel_manager/viewChapter')}}/{{$novels[0]->id}}/{{1}}"><button>VER NOVELA</button></a>
            @endif
        </div>
        
        @if ($errors->any())
            <table>
            @foreach ($errors->all() as $error)
                <tr><td><a>{{ $error }}</a></td></tr>
            @endforeach
            </table>
        @endif
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
                    <a href="{{route('goVC',['id'=>$novels[0]->id,'chapter'=>$chapter->id])}}">{{ $chapter->title }}</a>
                </td>
                <td>
                    {{ $chapter->views }}
                </td>
            </tr>
            @endforeach
    </table>
    <a href="{{url('novel_manager')}}/{{$novels[0]->id}}/add_chapter"><button>Crear capitulo</button></a>
        </div>
    </div>
</body>
</html>