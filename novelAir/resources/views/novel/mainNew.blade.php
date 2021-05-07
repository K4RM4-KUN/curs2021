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
    <div class="flex">
        <div class="bg-black bg-opacity-60 | ml-5 lg:ml-10| w-11/12 lg:w-9/12">
            <div class="flex w-full mx-5 p-5 pb-5">
                <div class="flex flex-col items-center justify-center" style="width:25%;">
                    <img class="w-full border-b-8 border-red-700" src="{{asset($novel[0]->novel_dir.'/cover'.$novel[0]->imgtype)}}" alt="{{$novel[0]->name}}">
                    <div class="w-full ">
                        <p class="p-2 bg-{{$novel[0]->novel_type}} font-bold text-3xl text-white text-center border-b-2 border-white">{{$mark}}/10</p>
                        <div class="flex">
                            <a class="w-3/6" href="{{url('vote/'.$novel[0]->id.'/pos')}}">
                                <p class="text-white text-center font-bold bg-green-500 rounded-bl">
                                    Me gusta
                                </p>
                            </a>
                            <a class="w-3/6" href="{{url('vote/'.$novel[0]->id.'/neg')}}">
                                <p class="text-white text-center border-l-2  font-bold bg-red-500 rounded-br">
                                    No gusta
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="m-5 w-4/6">
                    <div class="flex">
                        <p class="p-5 pb-0 text-white text-3xl truncate">
                            {{$novel[0]->name}}
                        </p>
                        <p class="my-5 mb-0 px-2 
                        text-white rounded font-bold shadow
                        bg-{{$novel[0]->novel_type}}
                        text-2xl">
                            {{strtoupper($novel[0]->novel_type)}}
                        </p>
                    </div>
                    <div>
                        <p class="p-5 text-white text-lg truncate">
                            {{$novel[0]->sinopsis}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap justify-center w-full mb-5 bg-black bg-opacity-80">
                <a class="mx-5 py-1 px-2.5 
                text-center 
                @if($userUNS[0]->state_name == 'following')
                border-b-4 border-ourBlue 
                @endif" 
                href="{{url('lista/following/'.$novel[0]->id)}}">
                    <p class="text-xl text-gray-300">{{$followers}}</p>
                    <p class="text-gray-50 font-bold">SIGUIENDO</p>
                </a>

                <a class="mx-5 py-1 px-2.5 
                text-center 
                @if($userUNS[0]->state_name == 'pending')
                border-b-4 border-yellow-600 
                @endif" 
                href="{{url('lista/pending/'.$novel[0]->id)}}">
                    <p class="text-xl text-gray-300">{{$pending}}</p>
                    <p class="text-gray-50 font-bold">PENDIENTE</p>
                </a>

                <a class="mx-5 py-1 px-2.5 
                text-center 
                @if($userUNS[0]->state_name == 'readed')
                border-b-4 border-green-600 
                @endif" 
                href="{{url('lista/readed/'.$novel[0]->id)}}">
                    <p class="text-xl text-gray-300">{{$readed}}</p>
                    <p class="text-gray-50 font-bold">LEIDO</p>
                </a>

                <a class="mx-5 py-1 px-2.5 
                text-center 
                @if($userUNS[0]->state_name == 'favorite')
                border-b-4 border-red-500 
                @endif" 
                href="{{url('lista/favorite/'.$novel[0]->id)}}">
                    <p class="text-xl text-gray-300">{{$favorite}}</p>
                    <p class="text-gray-50 font-bold">FAVORITO</p>
                </a>

                <a class="mx-5 py-1 px-2.5 
                text-center 
                @if($userUNS[0]->state_name == 'abandoned')
                border-b-4 border-indigo-500 
                @endif" 
                href="{{url('lista/abandoned/'.$novel[0]->id)}}">
                    <p class="text-xl text-gray-300">{{$abandoned}}</p>
                    <p class="text-gray-50 font-bold">ABANDONADO</p>
                </a>
                
            </div>
            <div class="flex flex-wrap  | w-12/12 |">
                <div class="flex w-1/1 justify-center">
                @if (true)
                    <a href="">
                        <p class="border-2 border-green-500 p-1 mx-2.5 rounded text-white text-green-500 font-bold">
                        Continuar leyendo
                        </p>
                    </a>
                @endif
                    <a class="" href="">
                        <p class="border-2 border-red-500 p-1 mx-2.5 rounded text-white text-red-500 font-bold">
                        Desmarcar todos
                        </p>
                    </a>
                    <a class="" href="">
                        <p class="border-2 border-blue-400 mx-2.5 p-1 rounded text-blue-400 font-bold">
                        Ascendente
                        </p>
                    </a>
                </div>
            </div>
            <div class="| w-8/12 | mx-auto mb-5">
                @foreach($chapters as $chapter)
                    <a href="{{url('leer/'.$novel[0]->id.'/'.$chapter->chapter_n)}}">
                        <div class="mb-1 flex bg-black bg-opacity-60 border-b-2 border-ourBlue">
                            <div>
                                <p class="pl-16 py-2.5 text-white text-left text-lg truncate">
                                    Capítulo {{$chapter->chapter_n}}: {{$chapter->title}}
                                </p>
                            </div>
                            <div>
                                <p class="text-green-500 text-right text-white">
                                    @if($loop->index <= $views[0]->chapter_n)
                                        visto
                                    @else
                                        nuevo
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="hidden lg:flex flex-shrink-0 align-center justify-center | w-3/12">
            @include('feature.popularNovelsSidebar')
        </div>
    </div>
</body>
</html>