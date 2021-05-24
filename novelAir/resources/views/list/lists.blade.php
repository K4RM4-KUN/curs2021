<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ucfirst($list_type)}}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    </head>

    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">

        @include('layouts.navigationNew')

        <!--Main div-->
        <div class="flex">
            <div class="w-11/12 | mx-auto | bg-black bg-opacity-30">
                <div class="flex | bg-black bg-opacity-60">
                    <div class="w-6/12 | m-5">
                        <p class="font-bold text-ourBlue text-xs sm:text-3xl | pl-5"> Estas son tus listas...</p>
                    </div>
                    <div class="w-6/12 | m-5">
                        <a class="flex justify-end" href="@if($filterIs == 'all') {{url('listas/'.$list_type)}} @else {{url('listas/'.$list_type.'/all')}} @endif">
                            <p class="border-2 rounded border-green-500 | font-bold text-green-500 text-xs sm:text-base | p-2">@if($filterIs == 'all')Mostrar nuevas @else Mostrar todas @endif</p>
                        </a>
                    </div>
                </div>
                <!--Lists-->
                <div class="flex flex-wrap items-end justify-center sm:justify-around | bg-black bg-opacity-60">
                    
                    <a href="{{url('listas/following')}}">

                        <div class=" | px-1.5 my-1 | rounded-t @if($list_type == 'following') border-b-4 border-ourBlue @endif">

                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">{{$followers}}</p>
                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">SIGUIENDO</p>

                        </div>

                    </a>
                    <a href="{{url('listas/pending')}}">

                        <div class=" | px-1.5 my-1 | rounded-t @if($list_type == 'pending') border-b-4 border-yellow-600 @endif">

                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">{{$pending}}</p>
                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">PENDIENTES</p>

                        </div>

                    </a>
                    <a href="{{url('listas/readed')}}">

                        <div class="| px-1.5 my-1 | rounded-t @if($list_type == 'readed') border-b-4 border-green-600 @endif">

                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">{{$readed}}</p>
                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">LEIDOS</p>

                        </div>

                    </a>
                    <a href="{{url('listas/favorite')}}">

                        <div class="| px-1.5 my-1 | rounded-t @if($list_type == 'favorite') border-b-4 border-red-500 @endif">

                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">{{$favorite}}</p>
                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">FAVORITOS</p>

                        </div>

                    </a>
                    <a href="{{url('listas/abandoned')}}">

                        <div class=" | px-1.5 my-1 | rounded-t @if($list_type == 'abandoned') border-b-4 border-indigo-500 @endif">

                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">{{$abandoned}}</p>
                            <p class="| text-center text-xs sm:text-sm md:text-base text-white font-bold">ABANDONADOS</p>

                        </div>

                    </a>

                </div>

                <!--Novel list-->
                <div class="flex flex-wrap | w-1/1">

                    @if(count($novels)==0)

                        <div class="flex items-center justify-center | w-1/1 | mx-auto">

                            <p class="p-5 | text-center text-xs sm:text-base text-white font-bold">Esta lista esta vacia...</p>

                        </div>

                    @endif

                    @foreach($novels as $novel)
                        
                        <a class="w-1/2 sm:w-3/12 lg:w-2/12 " href="{{url('novel/'.$novel->id)}}">
                                
                            <div class="flex flex-col | h-64 lg:h-80 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                                <div class=" w-full | h-full">

                                    <div class="w-full">
                                        
                                        <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$novel->name}}</p>

                                    </div>

                                    <div class="w-1/1 | flex justify-between | |">
                                        
                                        <p class="bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold">{{strtoupper($novel->novel_type)}}</p>
                                        <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>

                                    </div>
                                    
                                </div>
                            
                                <div class="w-full">
                                    
                                    <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">{{$novel->lastview}} / {{$novel->lastchapter}}</p>
 
                                </div>
                            </div>

                        </a>

                    @endforeach

                </div>

            </div>

        </div>

        @include('layouts.footer')
    </body>
</html>