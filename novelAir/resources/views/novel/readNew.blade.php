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
    <?php 
        $x = 0;
        foreach ($chapters as $ch){
            if ($ch == $chapter[0]){
                $chapterIndex = $x;
            }
            $x++;
        }
    ?>
</head>
<body>
    <center>
        <a href="{{url('novel')}}/{{$novel[0]->id}}"><button>BACK</button></a><br>
        @if ($chapter[0]->chapter_n != $chapters[count($chapters)-1]->chapter_n)
            @if ($chapter[0]->chapter_n-1 == $chapters[$chapterIndex+1]->chapter_n)
                <a href="{{url('leer')}}/{{$novel[0]->id}}/{{$chapter[0]->chapter_n-1}}"><button>Anterior capitulo</button></a>
            @endif
        @endif
        /
        @if (($chapter[0]->chapter_n != $chapters[0]->chapter_n))<!-- ($chapter[0]->chapter_n+1 == ) -->
            @if ($chapter[0]->chapter_n+1 == $chapters[$chapterIndex-1]->chapter_n)
                <a href="{{url('leer')}}/{{$novel[0]->id}}/{{$chapter[0]->chapter_n+1}}"><button>Siguiente capitulo</button></a>
            @endif
        @endif
        <br><br><br>
        {{$chapter[0]->chapter_n}}

        @foreach ($content as $c)
            <img src="{{url($chapter[0]->route)}}{{'/'.$c->getFilename()}}"><br>
        @endforeach

        <br><br>

        @if ($chapter[0]->chapter_n != $chapters[count($chapters)-1]->chapter_n)
            @if ($chapter[0]->chapter_n-1 == $chapters[$chapterIndex+1]->chapter_n)
                <a href="{{url('leer')}}/{{$novel[0]->id}}/{{$chapter[0]->chapter_n-1}}"><button>Anterior capitulo</button></a>
            @endif
        @endif
        /
        @if (($chapter[0]->chapter_n != $chapters[0]->chapter_n))<!-- ($chapter[0]->chapter_n+1 == ) -->
            @if ($chapter[0]->chapter_n+1 == $chapters[$chapterIndex-1]->chapter_n)
                <a href="{{url('leer')}}/{{$novel[0]->id}}/{{$chapter[0]->chapter_n+1}}"><button>Siguiente capitulo</button></a>
            @endif
        @endif    
    </center>
</body>
</html>