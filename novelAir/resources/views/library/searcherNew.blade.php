<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script id="functions" src="{{ asset('js/searcherJS.js') }}" defer></script>
</head>
<body>
    <form action="{{route('goLibraryResult')}}" method="post">
        @csrf
        <div>
            <input type="text" name="type" hidden value="{{$type}}">
            <input type="text" name="searcher" placeholder="Buscar..." value="{{$filters['text']}}">
            <input type="submit" valie="Buscar">
        </div>
        <div>
            <div>
                {{$filters["order"]}}
                <label for="order">Order</label>
                <select name="order" id="order">
                    <option value="desc" @if ($filters["order"] == 0) selected @endif>Más nuevos</option>
                    <option value="asc" @if ($filters["order"] == 1) selected @endif>Más viejos</option>
                    <option value="more" @if ($filters["order"] == 2) selected @endif>Más capitulos</option>
                    <option value="minus" @if ($filters["order"] == 3) selected @endif>Menos capitulos</option>
                    <option value="alfa" @if ($filters["order"] == 4) selected @endif>Alfabetico</option>
                    <option value="alfaC" @if ($filters["order"] == 5) selected @endif>Contrario al alfabetico</option>
                    <option value="moreMark" @if ($filters["order"] == 6) selected @endif>Más buenos</option>
                    <option value="minMark" @if ($filters["order"] == 7) selected @endif>Más malos</option>
                </select>
                <div>
                <label for="both">Ambos</label>
                <input type="checkbox" name="both" value="both" @if ($filters["adult_content"] == 0) checked @endif>:
                <label for="adult_content">+18</label>
                <input type="checkbox" name="adult_content" value="0" @if ($filters["adult_content"] == 1) checked @endif>
                </div>
            </div>
            <!--VisualNovel type-->
            @if($type == 1)
                <div>
                    <label for="all">Todos</label>
                    <input type="checkbox" name="all" value="all" @if ($filters["type"]["all"] == 0) checked @endif>:
                    <label for="manhwa">Manhwa</label>
                    <input type="checkbox" name="manhwa" value="manhwa" @if ($filters["type"]["manhwa"] == 1) checked @endif>
                    <label for="manhua">Manhua</label>
                    <input type="checkbox" name="manhua" value="manhua" @if ($filters["type"]["manhua"] == 1) checked @endif>
                    <label for="manga">Manga</label>
                    <input type="checkbox" name="manga" value="manga" @if ($filters["type"]["manga"] == 1) checked @endif>
                    <label for="oneShot">One Shot</label>
                    <input type="checkbox" name="oneShot" value="oneShot" @if ($filters["type"]["oneShot"] == 1) checked @endif>
                </div>
            @endif
            <div>
                <label for="bothE">Ambos</label>
                <input type="checkbox" name="bothE" value="bothE" @if ($filters["finished"] == 0) checked @endif>:
                <label for="ended">Finalizado</label>
                <input type="checkbox" name="ended" value="ended" @if ($filters["finished"] == 1) checked @endif>
            </div>
            <div>
                <label for="markOrder">Nota:</label>
                <select name="markOrder" id="markOrder">
                    <option value="mas">Mayor</option>
                    <option value="men">Menor</option>
                </select>
                <input type="number" name="mark" value="0" min="0" max="10">
            </div>
            <div>
                <label for="filtrarTag">
                    Filtrar por tag
                </label>
                <input name="filtrarTag" id="filtrarTag" type="checkbox" @if ($filters["tag"] != 0) checked @endif>
                <div class="tagsDiv">
                    @foreach ($tags as $tag)
                        <input type="radio" id="{{$tag->id}}" name="tag" value="{{$tag->id}}" @if ($filters["tag"] == $tag->id) checked @endif>
                        <label for="{{$tag->id}}">{{$tag->tag_name}}</label><br>
                    @endforeach
                </div>
            </div>

        </div>
    </form>
    <div>
    <br><br><br>
        @if($results[0]->name != null)
            <table border="1">
                <tr>
                    <th colspan="3">
                        SEARCH RESULT
                    </th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Capitulos</th>  
                    <th>READ</th>      
                </tr>
                @foreach($results as $result)
                    <tr style="text-align:center;">
                        <td>{{$result->name}}</td>
                        <td>{{$result->chapters_count}}</td>
                <td><a href="{{url('novel/'.$result->id)}}"><button>READ</button></a></td>
                    </tr>
                @endforeach
            </table>
        @else
            No se ha encontrado nada
        @endif<br><br><br>
        <table border="1">
            <tr>
                <th colspan="3">
                    LAST CONTENT
                </th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Capitulos</th>    
                <th>READ</th>    
            </tr>
            @foreach($novels as $novel)
            <tr style="text-align:center;">
                <td>{{$novel->name}}</td>
                <td>{{$novel->chapters_count}}</td>
                <td><a href="{{url('novel/'.$novel->id)}}"><button>READ</button></a></td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>