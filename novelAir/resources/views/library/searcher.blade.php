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
        <div class="flex | w-full | bg-black bg-opacity-60">
            <div class="w-1/1 | my-5">
                <p class="font-bold text-ourBlue text-3xl | pl-5"> Buscador avanzado</p>
            </div>
        </div>
        <!-- Folmualrio -->
        <div class="w-full sm:w-4/12 | text-white">
            <div class="bg-white bg-opacity-25 | m-1 sm:m-4 | w-1/1">
                <form action="{{route('goLibraryResult')}}" method="post" class="p-3 w-1/1">
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
                            <div class="my-4 ml-3">
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

                            <!--VisualNovel type-->
                            @if($type == 1)
                                <hr class="w-9/12 mx-auto justify-items-center">
                                <div class="my-4 ml-3">
                                    <div>
                                        <p>Tipo de Visual Novel</p>
                                        <input type="checkbox" name="all" id="all" value="all" @if ($filters["type"]["all"] == 0) checked @endif>
                                        <label for="all">Todos</label>
                                        <div id="novelVisualType" class="flex flex-wrap ml-3">
                                            <div class="bg-manhwa p-1 pr-2 rounded-full mr-3 mb-3">
                                                <input type="radio" name="typeVN" id="manhwa" value="manhwa" @if ($filters["type"]["typeVN"] == "manhwa") checked @endif>
                                                <label for="manhwa">Manhwa</label>
                                            </div>
                                            <div class="bg-manhua p-1 pr-2 rounded-full mr-3 mb-3">
                                                <input type="radio" name="typeVN" id="manhua" value="manhua" @if ($filters["type"]["typeVN"] == "manhua") checked @endif>
                                                <label for="manhua">Manhua</label>
                                            </div>
                                            <div class="bg-manga p-1 pr-2 rounded-full mr-3 mb-3">
                                                <input type="radio" name="typeVN" id="manga" value="manga" @if ($filters["type"]["typeVN"] == "manga") checked @endif>
                                                <label for="manga">Manga</label>
                                            </div>
                                            <div class="bg-oneShot p-1 pr-2 rounded-full mb-3">
                                                <input type="radio" name="typeVN" id="oneShot" value="oneShot" @if ($filters["type"]["typeVN"] == "oneShot") checked @endif>
                                                <label for="oneShot">One Shot</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Finalizado -->
                            <div class="my-4 ml-3">
                                <p>Finalizado</p>
                                <input type="checkbox" name="bothE" id="bothE" value="bothE" @if ($filters["finished"] == 0) checked @endif>
                                <label for="bothE">Todos</label>
                                <div id="finished" class="flex flex-wrap ml-3">
                                    <div class="bg-black p-1 pr-2 rounded-full mr-3 mb-3">
                                        <input type="radio" name="endedRario" id="notEnded" value="notEnded" @if ($filters["finished"] == 2) checked @endif>
                                        <label for="notEnded">No finalizado</label>
                                    </div>
                                    <div class="bg-black p-1 pr-2 rounded-full mb-3">
                                        <input type="radio" name="endedRario" id="ended" value="ended" @if ($filters["finished"] == 1) checked @endif>
                                        <label for="ended">Finalizado</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Nota
                                <div class="my-4 ml-3">
                                    <label for="markOrder">Nota:</label>
                                    <select name="markOrder" class="text-black" id="markOrder">
                                        <option value="mas">Mayor</option>
                                        <option value="men">Menor</option>
                                    </select>
                                    <input type="number" class="text-black" name="mark" value="0" min="0" max="10">
                                </div>

                                <hr class="w-9/12 mx-auto justify-items-center">
                            -->

                            <!-- +18 -->
                            <div class="my-4 ml-3">
                                <p>Contenido Adulto</p>
                                <input type="checkbox" name="both" id="both" value="both" @if ($filters["adult_content"] == 0) checked @endif>
                                <label for="both">Todos</label>
                                <div id="18div" class="flex flex-wrap ml-3">
                                    <div class="bg-black p-1 pr-2 rounded-full mr-3 mb-3">
                                        <input type="radio" name="adult_content" id="menos18" value="menos18" @if ($filters["adult_content"] == 1) checked @endif>
                                        <label for="menos18">-18</label>
                                    </div>
                                    <div class="bg-black p-1 pr-2 rounded-full mb-3">
                                        <input type="radio" name="adult_content" id="mas18" value="mas18" @if ($filters["adult_content"] == 2) checked @endif>
                                        <label for="mas18">+18</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Tags -->
                            <div class="my-4 ml-3">
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

        <!-- Div de las novelas -->
        <div class="w-1/1 sm:w-8/12 mx-auto text-white">

            <!-- Resultados de la busqueda -->
            @if($results[0]->name != null)   
                <p class="text-2xl font-bold text-white | border-b-2 | my-1 mt-5">Resultados de la Busqueda</p>&nbsp
                <div class="w-1/1 | mb-12 | flex flex-wrap">
            
                    @foreach($results as $result)
                        <a class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12" href="{{url('novel/'.$result->id)}}">
                                
                            <div class="flex flex-col | h-60 lg:h-42 xl:h-56 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                                <div class=" w-full | h-full">

                                    <div class="w-full">
                                        
                                        <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>

                                    </div>

                                    <div class="w-1/1 | flex justify-between | |">
                                        
                                        <p class="bg-{{$result->novel_type}} | px-1 m-0.5 | rounded | text-xs text-white font-bold">{{strtoupper($result->novel_type)}}</p>
                                        <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$result->mark}}/10</p>

                                    </div>
                                    
                                </div>
                            
                                <div class="w-full">
                                    
                                    <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">{{strtoupper($result->genre)}}</p>
 
                                </div>
                            </div>

                        </a>
                    @endforeach

                </div>
            @endif
            
            <!-- Ultimas añadidas -->
            <p class="text-2xl font-bold text-white | border-b-2 | my-1 mt-5">Ultimas Añadidas</p>&nbsp
            
            <div class="w-1/1 flex flex-wrap">
                @foreach($novels as $result)
                    <a class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12" href="{{url('novel/'.$result->id)}}">
                            
                        <div class="flex flex-col | h-60 lg:h-42 xl:h-56 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                            <div class=" w-full | h-full">

                                <div class="w-full">
                                    
                                    <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>

                                </div>

                                <div class="w-1/1 | flex justify-between | |">
                                    
                                    <p class="bg-{{$result->novel_type}} | px-1 m-0.5 | rounded | text-xs text-white font-bold">{{strtoupper($result->novel_type)}}</p>
                                    <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$result->mark}}/10</p>

                                </div>
                                
                            </div>
                        
                            <div class="w-full">
                                
                                <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">{{strtoupper($result->genre)}}</p>

                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>