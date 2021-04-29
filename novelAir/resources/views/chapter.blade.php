<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <a href="{{url('novel_manager')}}/{{$novel[0]->id}}"><button>BACK</button></a><br><br>
        {{$chapter[0]->title}}<br><br>

        @foreach ($content as $c)
            <img src="{{url($chapter[0]->route)}}{{'/'.$c->getFilename()}}"><br>
        @endforeach

        <br><br>

        @if ($chapter[0]->chapter_n != $chapters[count($chapters)-1]->chapter_n)
            <a href="{{url('novel_manager/viewChapter')}}/{{$novel[0]->id}}/{{$chapter[0]->chapter_n-1}}"><button>Anterior capitulo</button></a>
        @endif

        @if (($chapter[0]->chapter_n != $chapters[0]->chapter_n))<!-- ($chapter[0]->chapter_n+1 == ) -->
            <a href="{{url('novel_manager/viewChapter')}}/{{$novel[0]->id}}/{{$chapter[0]->chapter_n+1}}"><button>Siguiente capitulo</button></a>
        @endif    
    </center>
</body>
</html>