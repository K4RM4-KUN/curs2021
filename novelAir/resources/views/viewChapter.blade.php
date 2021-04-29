<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{url('novel_manager')}}/{{$novels[0]->id}}}"><button>BACK</button></a>
    <divs style="display:flex;">
        <div style="margin-right: 150px;">
            <form action="{{route('editChapter')}}" method="POST">
            @csrf
                <input type="text" hidden name="id" value="{{$chapter[0]->id}}"><br><br>
                <input type="text" hidden name="novel_id" value="{{$novels[0]->id}}"><br><br>
                <label for="title">Titulo:</label><br>
                <input type="text" name="title" value="{{$chapter[0]->title}}"><br><br>
                <label for="chapter_n">Numero:</label><br>
                <input type="number" name="chapter_n" value="{{$chapter[0]->chapter_n}}"><br><br>

                <input type="checkbox" name="public" id="public" @if ($chapter[0]->public) checked @endif>
                <label for="public">Publico</label><br><br>

                <input type="submit">
            </form>
            <a href="{{url('novel_manager/delChapter')}}/{{$chapter[0]->id}}"><button>ELIMINAR</button></a>
            <a href="{{url('novel_manager')}}/chapterImages/{{$novels[0]->id}}/{{$chapter[0]->id}}"><button>GESTOR IMAGENES</button></a><br><br>
        </div>
        <div>
        </div>
    </div>
</body>
</html>