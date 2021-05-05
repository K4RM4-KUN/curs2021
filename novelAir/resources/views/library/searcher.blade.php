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
            <input type="text" name="searcher" placeholder="Buscar...">
            <input type="submit" valie="Buscar">
        </div>
        <div>
            <div>
                <label for="order">Order</label>
                <select name="order" id="order">
                    <option value="desc">Más nuevos</option>
                    <option value="asc">Más viejos</option>
                    <option value="more">Más capitulos</option>
                    <option value="minus">Menos capitulos</option>
                    <option value="alfa">Alfabetico</option>
                    <option value="alfaC">Contrario al alfabetico</option>
                    <option value="moreMark">Más buenos</option>
                    <option value="minMark">Más malos</option>
                </select>
                <div>
                <label for="both">Ambos</label>
                <input type="checkbox" name="both" value="both" checked>:
                <label for="adult_content">+18</label>
                <input type="checkbox" name="adult_content" value="0">
                </div>
            </div>
            <!--VisualNovel type-->
            @if($type == 1)
                <div>
                    <label for="all">Todos</label>
                    <input type="checkbox" name="all" value="all" checked>:
                    <label for="manhwa">Manhwa</label>
                    <input type="checkbox" name="manhwa" value="manhwa">
                    <label for="manhua">Manhua</label>
                    <input type="checkbox" name="manhua" value="manhua">
                    <label for="manga">Manga</label>
                    <input type="checkbox" name="manga" value="manga">
                    <label for="oneShot">One Shot</label>
                    <input type="checkbox" name="oneShot" value="oneShot">
                </div>
            @endif
            <div>
                <label for="bothE">Ambos</label>
                <input type="checkbox" name="bothE" value="bothE" checked>:
                <label for="ended">Finalizado</label>
                <input type="checkbox" name="ended" value="ended">
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
                <input name="filtrarTag" id="filtrarTag" type="checkbox">
                <div class="tagsDiv">
                    @foreach ($tags as $tag)
                        <input type="radio" id="{{$tag->id}}" name="tag" value="{{$tag->id}}" checked>
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