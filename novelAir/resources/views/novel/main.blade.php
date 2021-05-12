<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$novel[0]->name}}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    </head>

    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">

        @include('layouts.navigationNew')

        <div class="flex w-full">

            <!--Main novel-->
            <div class="w-10/12 mx-auto | bg-black bg-opacity-30">

                <div class="flex | w-1/1">

                    <!--Image and image frame -->
                    <div class="w-1/1 sm:w-2/6">

                        <div class="flex flex-col | | w-1/2 | mx-auto | mx-auto | w-48 sm:w-64">

                            <p class="text-white text-center text-base font-bold | my-1 mt-5 | rounded | bg-{{$novel[0]->novel_type}}">
                                {{strtoupper($novel[0]->novel_type)}}
                            </p>

                            <img class="w-1/1" src="{{asset($novel[0]->novel_dir.'/cover'.$novel[0]->imgtype)}}" alt="{{$novel[0]->name}}">

                            <p class="text-white text-center text-2xl font-bold | mt-2 | rounded-t | bg-{{$novel[0]->novel_type}}">
                                {{$mark}}/10
                            </p>

                            <div class="flex w-1/1">

                                <a class="w-1/2" href="{{url('vote/'.$novel[0]->id.'/pos')}}">
                                    <p class="text-green-400 text-center text-base sm:text-2xl font-bold | py-0.5 | border-b-4 border-green-500 | bg-green-800 bg-opacity-60">
                                        LIKE
                                    </p>
                                </a>

                                <a class="w-1/2" href="{{url('vote/'.$novel[0]->id.'/neg')}}">
                                    <p class="text-red-400 text-center text-base sm:text-2xl font-bold | py-0.5 | border-b-4 border-red-500 | bg-red-800 bg-opacity-60">
                                        DISLIKE
                                    </p>
                                </a>
                            </div>

                            <div class="flex sm:hidden justify-left | w-1/1 | mt-5 mb-2">
                                <p class="text-base text-white | border-b-2">{{$novel[0]->name}}</p>
                            </div>
                            <div class="flex sm:hidden justify-left | w-1/1 | ">
                                <p class="pl-2 | text-sm text-gray-300">{{substr($novel[0]->sinopsis,0,100)}}...</p>
                            </div>
                            <div class="block sm:hidden | mr-2.5">
                                <div class="flex | w-1/1">
                                    <p class="text-base font-bold text-white | mt-5 | rounded">
                                        Estado
                                    </p>
                                </div>

                                <div class="flex | w-1/1">
                                @if($novel[0]->ended == 0)
                                    <p class="text-sm font-bold text-green-500 | ml-2 px-2 mt-1 | border-2 border-green-500 rounded">
                                        PUBLICANDOSE
                                    </p>
                                    @else
                                    <p class="text-sm font-bold text-red-500 | ml-2 px-2 mt-1 | border-2 border-red-500 rounded">
                                        FINALIZADA
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex sm:hidden | w-1/1 | my-5">
                                <a class="flex" href="{{url('perfil/'.$author[0]->id.'/'.$author[0]->username)}}">
                                    <p class="text-base font-bold text-white | mt-4 | rounded">
                                        Author: {{$author[0]->username}}
                                    </p>
                                    <img class="w-16 h-16 | rounded-full | ml-2" src="{{asset('users/'.$author[0]->id.'/profile/usericon'.$author[0]->imgtype)}}?date={{$author[0]->created_at}}" alt="">
                                </a>
                            </div>

                        </div>

                    </div>
                    
                    <!--Novel info-->
                    <div class="hidden sm:block | w-4/6">

                        <div class="sm:ml-24 lg:m-5">

                            <div class="flex flex-wrap | w-1/1">
                                <p class="text-2xl font-bold text-white | border-b-2 | my-1 mt-5">{{$novel[0]->name}}</p>&nbsp
                                <p class="text-xl font-bold text-white | my-1 mt-5">{{explode(" ",$novel[0]->created_at)[0]}}</p>
                            </div>

                            <div class="flex | w-4/6">
                                <p class="text-base font-bold text-gray-300 | pl-2">{{$novel[0]->sinopsis}}</p>
                            </div>

                            <div class="sm:hidden lg:flex | w-1/1">
                                <p class="text-base font-bold text-white | mt-5">Géneros</p>
                            </div>

                            <div class="flex | w-1/1">
                                <p class="text-sm font-bold text-white | pl-2 mt-1">
                                    @foreach($tags as $tag)
                                        {{$tag->tag_name}}@if(!$loop->last),@endif &nbsp
                                    @endforeach
                                </p>
                            </div>

                            <div class="mr-2.5">
                                <div class="flex | w-1/1">
                                    <p class="text-base font-bold text-white | mt-5 | rounded">
                                        Estado
                                    </p>
                                </div>

                                <div class="flex | w-1/1">
                                @if($novel[0]->ended == 0)
                                    <p class="text-sm font-bold text-green-500 | ml-2 px-2 mt-1 | border-2 border-green-500 rounded">
                                        PUBLICANDOSE
                                    </p>
                                    @else
                                    <p class="text-sm font-bold text-red-500 | ml-2 px-2 mt-1 | border-2 border-red-500 rounded">
                                        FINALIZADA
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex | w-1/1 | mt-10">
                                <a class="flex" href="{{url('perfil/'.$author[0]->id.'/'.$author[0]->username)}}">
                                    <p class="text-base font-bold text-white | mt-4 | rounded">
                                        Author: {{$author[0]->username}}
                                    </p>
                                    <img class="w-16 h-16 | rounded-full | ml-2" src="{{asset('users/'.$author[0]->id.'/profile/usericon'.$author[0]->imgtype)}}?date={{$author[0]->created_at}}" alt="">
                                </a>
                            </div>
                            

                        </div>

                    </div>
                
                </div>

                <!--Lists bar-->
                <div class="flex flex-wrap items-center justify-center sm:justify-around  | w-full | my-5 | bg-black bg-opacity-60">
                    <a class="mx-5 py-1 px-2.5 
                    text-center 
                    @if($userUNS[0]->state_name == 'following')
                    border-b-4 border-ourBlue 
                    @endif" 
                    href="{{url('lista/following/'.$novel[0]->id)}}">
                        <p class="text-xl text-gray-300">{{$followers}}</p>
                        <p class="text-xs sm:text-sm md:text-base text-gray-50 font-bold">SIGUIENDO</p>
                    </a>

                    <a class="mx-5 py-1 px-2.5 
                    text-center 
                    @if($userUNS[0]->state_name == 'pending')
                    border-b-4 border-yellow-600 
                    @endif" 
                    href="{{url('lista/pending/'.$novel[0]->id)}}">
                        <p class="text-xl text-gray-300">{{$pending}}</p>
                        <p class="text-xs sm:text-sm md:text-base text-gray-50 font-bold">PENDIENTE</p>
                    </a>

                    <a class="mx-5 py-1 px-2.5 
                    text-center 
                    @if($userUNS[0]->state_name == 'readed')
                    border-b-4 border-green-600 
                    @endif" 
                    href="{{url('lista/readed/'.$novel[0]->id)}}">
                        <p class="text-xl text-gray-300">{{$readed}}</p>
                        <p class="text-xs sm:text-sm md:text-base text-gray-50 font-bold">LEIDO</p>
                    </a>

                    <a class="mx-5 py-1 px-2.5 
                    text-center 
                    @if($userUNS[0]->state_name == 'favorite')
                    border-b-4 border-red-500 
                    @endif" 
                    href="{{url('lista/favorite/'.$novel[0]->id)}}">
                        <p class="text-xl text-gray-300">{{$favorite}}</p>
                        <p class="text-xs sm:text-sm md:text-base text-gray-50 font-bold">FAVORITO</p>
                    </a>

                    <a class="mx-5 py-1 px-2.5 
                    text-center 
                    @if($userUNS[0]->state_name == 'abandoned')
                    border-b-4 border-indigo-500 
                    @endif" 
                    href="{{url('lista/abandoned/'.$novel[0]->id)}}">
                        <p class="text-xl text-gray-300">{{$abandoned}}</p>
                        <p class="text-xs sm:text-sm md:text-base text-gray-50 font-bold">ABANDONADO</p>
                    </a>
                    
                </div>

                <!--Chapters-->
                <div class="| w-full">
                        <div class="flex justify-center | w-1/1 | my-2.5 mb-6">
                            <a class="" @if($lastView != null) href="{{url('leer')}}/{{$novel[0]->id}}/{{$lastView}}" @else href="#" @endif>
                                <p class="p-1 mx-0 sm:mx-5 | text-green-500 text-xs sm:text-base | border-2 border-green-500 rounded ">Seguir Leyendo</p>
                            </a>
                            <a class="" href="{{url('deleteMark/'.$novel[0]->id)}}">
                                <p class="p-1 mx-0 sm:mx-5 | text-red-500 text-xs sm:text-base | border-2 border-red-500 rounded ">Desmarcar Todos</p>
                            </a>
                            <a class="" 
                            @if($chaptersOrder == "asc") 
                            href="{{url('novel/'.$novel[0]->id.'/desc')}}">
                            <p class="p-1 mx-0 sm:mx-5 | text-blue-500 text-xs sm:text-base | border-2 border-blue-500 rounded ">Descendente</p> 
                            @else 
                            href="{{url('novel/'.$novel[0]->id.'/asc')}}">
                            <p class="p-1 mx-0 sm:mx-5 | text-blue-500 text-xs sm:text-base | border-2 border-blue-500 rounded ">Ascendente</p> 
                            @endif
                                
                            </a>
                        </div>
                        <div class="pb-16">
                            @foreach($chapters as $chapter)
                                <a href="{{url('leer/'.$novel[0]->id.'/'.$chapter->chapter_n)}}">

                                    <div class="flex | pl-2.5 sm:pl-7 p-2.5 mx-5 sm:mx-32 | bg-black bg-opacity-70 | border-b-2 border-ourBlue @if($loop->first)border-t-4 border-ourBlue @endif ">

                                        <p class="text-white text-left text-xs sm:text-base | mr-2 sm:mr-4 | truncate">Capítulo {{$chapter->chapter_n}}: {{$chapter->title}}</p>
                                        
                                        <p class="text-xs sm:text-base
                                            @if($actualChapter == 'start')
                                                text-red-500">nuevo
                                            @elseif($chapter->chapter_n <= $actualChapter)
                                                text-green-500">visto
                                            @else
                                                text-red-500">nuevo
                                            @endif
                                        </p>
                                    </div>
                                    
                                </a>
                            @endforeach
                        </div>
                </div>
                
            </div>

        <!--<div class="hidden lg:block lg:w-3/12">

                    @@include('feature.sidebarNovelsNew')

            </div>-->

        </div>

    </body>

</html>