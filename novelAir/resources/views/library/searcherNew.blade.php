<!DOCTYPE html>
<html lang="esp">
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
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script id="functions" src="{{ asset('js/searcherJS.js') }}" defer></script>
</head>
<body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">
    
    @include('layouts.navigationNew')
    
    <div class="flex flex-wrap w-11/12 sm:w-10/12 mx-auto bg-black bg-opacity-30">

        <div class="w-1/1 sm:w-4/12 text-white">
            <div class="m-1 sm:m-4">
                <form action="{{route('goLibraryResulttest2')}}" method="post">
                    @csrf
                    <div>
                        <input type="text" name="type" hidden value="{{$type}}">
                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        type="text"
                        name="searcher"
                        placeholder="Buscar..."
                        value="{{$filters['text']}}">
                        <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        type="submit"
                        value="Acceptar">
                    </div>
                    <div class="my-2">
                        <div class="my-2">
                            <input class="form-checkbox h-4 w-4 text-blue"
                            name="more" 
                            id="more" 
                            type="checkbox" 
                            @if ($filters["more"] != 0) checked @endif>
                            <label for="more">
                                Buscador avanzado
                            </label>
                        </div>
                        <div id="moreDiv" class="my-2 flex flex-col">

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Orden -->
                            <div class="my-4">
                                <label for="order">Order</label>
                                <select name="order" class="text-black" id="order">
                                    <option value="desc" @if ($filters["order"] == 0) selected @endif>Más nuevos</option>
                                    <option value="asc" @if ($filters["order"] == 1) selected @endif>Más viejos</option>
                                    <option value="more" @if ($filters["order"] == 2) selected @endif>Más capitulos</option>
                                    <option value="minus" @if ($filters["order"] == 3) selected @endif>Menos capitulos</option>
                                    <option value="alfa" @if ($filters["order"] == 4) selected @endif>Alfabetico</option>
                                    <option value="alfaC" @if ($filters["order"] == 5) selected @endif>Contrario al alfabetico</option>
                                    <option value="moreMark" @if ($filters["order"] == 6) selected @endif>Más buenos</option>
                                    <option value="minMark" @if ($filters["order"] == 7) selected @endif>Más malos</option>
                                </select>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">
                            
                            <!--VisualNovel type-->
                            <div class="my-4">
                                @if($type == 1)
                                    <div>
                                        <p>Tipo de Visual Novel</p>
                                        <input type="checkbox" name="all" id="all" value="all" @if ($filters["type"]["all"] == 0) checked @endif>
                                        <label for="all">Todos</label>
                                        <div id="novelVisualType" class="flex flex-wrap">
                                            <div class="bg-manhwa p-1 pr-2 rounded-full">
                                                <input type="radio" name="typeVN" id="manhwa" value="manhwa" @if ($filters["type"]["typeVN"] == "manhwa") checked @endif>
                                                <label for="manhwa">Manhwa</label>
                                            </div>
                                            <div class="bg-manhua p-1 pr-2 rounded-full">
                                                <input type="radio" name="typeVN" id="manhua" value="manhua" @if ($filters["type"]["typeVN"] == "manhua") checked @endif>
                                                <label for="manhua">Manhua</label>
                                            </div>
                                            <div class="bg-manga p-1 pr-2 rounded-full">
                                                <input type="radio" name="typeVN" id="manga" value="manga" @if ($filters["type"]["typeVN"] == "manga") checked @endif>
                                                <label for="manga">Manga</label>
                                            </div>
                                            <div class="bg-oneShot p-1 pr-2 rounded-full">
                                                <input type="radio" name="typeVN" id="oneShot" value="oneShot" @if ($filters["type"]["typeVN"] == "oneShot") checked @endif>
                                                <label for="oneShot">One Shot</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Finalizado -->
                            <div class="my-4">
                                <p>Finalizado</p>
                                <input type="checkbox" name="bothE" id="bothE" value="bothE" @if ($filters["finished"] == 0) checked @endif>
                                <label for="bothE">Todos</label>
                                <div id="finished">
                                    <input type="radio" name="endedRario" id="ended" value="ended" @if ($filters["finished"] == 1) checked @endif>
                                    <label for="ended">Finalizado</label>
                                    <input type="radio" name="endedRario" id="notEnded" value="notEnded" @if ($filters["finished"] == 2) checked @endif>
                                    <label for="notEnded">No finalizado</label>
                                </div>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Nota -->
                            <div class="my-4">
                                <label for="markOrder">Nota:</label>
                                <select name="markOrder" class="text-black" id="markOrder">
                                    <option value="mas">Mayor</option>
                                    <option value="men">Menor</option>
                                </select>
                                <input type="number" class="text-black" name="mark" value="0" min="0" max="10">
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- +18 -->
                            <div class="my-4">
                                <input type="checkbox" name="both" id="both" value="both" @if ($filters["adult_content"] == 0) checked @endif>
                                <label for="both">Ambos</label>
                                <div id="18div">
                                    <input type="checkbox" name="adult_content" value="0" @if ($filters["adult_content"] == 1) checked @endif>
                                    <label for="adult_content">+18</label>
                                </div>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Tags -->
                            <div class="my-4">
                                <input name="filtrarTag" id="filtrarTag" type="checkbox" @if ($filters["tag"] != 0) checked @endif>
                                <label for="filtrarTag">
                                    Filtrar por tag
                                </label>
                                <div class="tagsDiv flex flex-wrap">
                                    @foreach ($tags as $tag)
                                        <div class="mx-2 my-1">
                                            <input type="radio" id="{{$tag->id}}" name="tag" value="{{$tag->id}}" @if ($filters["tag"] == $tag->id) checked @endif>
                                            <label for="{{$tag->id}}">{{$tag->tag_name}}</label><br>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-gold w-1/1 sm:w-8/12 mx-auto">
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
    </div>
</body>
</html>