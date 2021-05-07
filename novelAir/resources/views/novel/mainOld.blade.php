<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    /*
        if(Auth::check()){
            if (count($chapters) == 0){ //entra si la novela no tiene capitulos
                $lastView = null;
            }elseif (count($views)==1){ //entra al ultimo capitulo leido
                $lastView = $views[0]->chapter_n; //coge el capitulo de la DB
                
                $chapterIndex = false;
                foreach ($chapters as $ch){ //forech de todos los capitulos
                    if ($ch->chapter_n == $lastView+1){
                        $chapterIndex = true;
                    }
                }

                if ($chapterIndex){
                    $lastView = $lastView+1;
                }else {
                    $lastView = null;
                }

            }else{  //entra si no has empezado a ller la novela
                $lastView = $chapters[count($chapters)-1]->chapter_n;
            }
        } else {
            $lastView = $chapters[count($chapters)-1]->chapter_n;
        }
        */
    ?>
</head>

    <body>  

        <div style="display:flex;">

            <h2>{{$novel[0]->name}} -- by <a href="@{{url('account/')}}">{{$author[0]->username}}</a></h2>
        
        </div>

        <div style="width:400px; display:flex; margin-bottom:4rem;">
            <div>
                <img 
                style="margin-top:1rem;" 
                width="120px" 
                height="60%" 
                src="{{asset($novel[0]->novel_dir.'/cover'.$novel[0]->imgtype)}}" 
                alt="">
                <p>{{$mark}}/10</p>
                <a style="text-decoration:none;" href="{{url('vote/'.$novel[0]->id.'/pos')}}">
                    <button>
                        @if($liked->like == 1) Liked @else Like @endif
                    </button>
                </a>

                <a style="text-decoration:none;" href="{{url('vote/'.$novel[0]->id.'/neg')}}">
                    <button>
                        @if($liked->like == 0) Disliked @else Dislike @endif
                    </button>
                </a>

            </div>

            <div>
                <h5 style="margin-left:2rem;" >{{$novel[0]->sinopsis}}</h5>

                <h6 style="text-align:right;">{{count($chapters)}} Capitulo/s</h6>
            </div>

        </div>
        
        <div style="width:400px; margin-top:1rem;">

            <h5>

                @foreach($tags as $tag)

                    [{{ ucfirst(strtolower($tag->tag_name))}}]

                @endforeach

            </h5>

        </div>  

        <div style="margin-bottom:1rem;">

            <a style="text-decoration:none;" href="{{url('lista/following/'.$novel[0]->id)}}">

                <button>@if($userUNS[0]->state_name == "following")SIGUIENDO @else SEGUIR @endif{{$followers}}</button>

            </a>

            <a style="text-decoration:none;" href="{{url('lista/pending/'.$novel[0]->id)}}">

                <button>@if($userUNS[0]->state_name == "pending")PENDIENTE @else AÑADIR A PENDIENTES @endif{{$pending}}</button>

            </a>

            <a style="text-decoration:none;" href="{{url('lista/readed/'.$novel[0]->id)}}">

                <button>@if($userUNS[0]->state_name == "readed")LEIDO @else AÑADIR A LEIDOS @endif{{$readed}}</button>

            </a>

            <a style="text-decoration:none;" href="{{url('lista/favorite/'.$novel[0]->id)}}">

                <button>@if($userUNS[0]->state_name == "favorite")FAVORITO @else AÑADIR A FAVORITOS  @endif{{$favorite}}</button>

            </a>

            <a style="text-decoration:none;" href="{{url('lista/abandoned/'.$novel[0]->id)}}">

                <button>@if($userUNS[0]->state_name == "abandoned")ABANDONADO @else ABANDONAR @endif {{$abandoned}}</button>

            </a>


        </div>

        <div>
            @if ($lastView != null)
            <a style="text-decoration:none;margin-bottom:1rem;" href="{{url('leer')}}/{{$novel[0]->id}}/{{$lastView}}">

                <button>EMPEZAR A LEER</button>

            </a>
            @endif

            <table border="1px">

                <tr>

                    <th>Num.</th>
                    <th>Name</th>
                    <th>Read</th>
                    <th>Views</th>
                
                </tr>

                @foreach($chapters as $chapter)

                    <tr>

                        <td>{{$chapter->chapter_n}}</td>

                        <td>{{$chapter->title}}</td>

                        <td><a href="{{url('leer/'.$novel[0]->id.'/'.$chapter->chapter_n)}}"><button>READ</button></a></td>

                        <td>{{$chapter->views}}</td>

                    </tr>
                
                @endforeach

            </table>

        </div>

    </body>

</html>