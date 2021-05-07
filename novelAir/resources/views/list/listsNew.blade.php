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
            
                <!--Lists-->
                <div class="flex flex-wrap items-end justify-center | bg-black bg-opacity-60">
                    
                    <a href="{{url('test/following')}}">

                        <div class=" px-1.5 my-1 mx-2.5 | rounded-t border-b-4 border-ourBlue">

                            <p class="| text-center text-base text-white font-bold">{{$followers}}</p>
                            <p class="| text-center text-base text-white font-bold">SIGUIENDO</p>

                        </div>

                    </a>
                    <a href="{{url('test/pending')}}">

                        <div class=" px-1.5 my-1 mx-2.5 | rounded-t border-b-4 border-yellow-600 ">

                            <p class="| text-center text-base text-white font-bold">{{$pending}}</p>
                            <p class="| text-center text-base text-white font-bold">PENDIENTES</p>

                        </div>

                    </a>
                    <a href="{{url('test/readed')}}">

                        <div class=" px-1.5 my-1 mx-2.5 | rounded-t border-b-4 border-green-600 ">

                            <p class="| text-center text-base text-white font-bold">{{$readed}}</p>
                            <p class="| text-center text-base text-white font-bold">LEIDOS</p>

                        </div>

                    </a>
                    <a href="{{url('test/favorite')}}">

                        <div class=" px-1.5 my-1 mx-2.5 | rounded-t border-b-4 border-red-500 ">

                            <p class="| text-center text-base text-white font-bold">{{$favorite}}</p>
                            <p class="| text-center text-base text-white font-bold">FAVORITOS</p>

                        </div>

                    </a>
                    <a href="{{url('test/abandoned')}}">

                        <div class=" px-1.5 my-1 mx-2.5 | rounded-t border-b-4 border-indigo-500 ">

                            <p class="| text-center text-base text-white font-bold">{{$abandoned}}</p>
                            <p class="| text-center text-base text-white font-bold">ABANDONADOS</p>

                        </div>

                    </a>

                </div>

                <!--Novel list-->
                <div class="flex | w-1/1">

                    @foreach($novels as $novel)
                        <a class="flex flex-col items-center | my-2.5 | w-1/2" href="{{url('novel/'.$novel->id)}}">

                                <div class="my-0.5 mx-5 | w-10/12">
                                    
                                    <p class="bg-{{$novel->novel_type}} | w-1/1 | rounded | text-center text-xs text-white font-bold">{{strtoupper($novel->novel_type)}}</p>
                                
                                </div>

                                <img class="mx-5 | w-10/12" src="{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}" alt="">
                            
                                <div class="w-10/12 | mb-2.5">
                                    
                                    <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">{{$novel->name}}</p>
                                    <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">0/{{$novel->chapters_count}}</p>

                                </div>

                        </a>
                    @endforeach

                </div>

            </div>

        </div>
    </body>
</html>