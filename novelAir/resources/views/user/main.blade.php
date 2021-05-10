<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>THINGS</title>

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

        <div class="flex justify-center | w-full">

            <div class="w-11/12 | bg-black bg-opacity-30">

                <!--Header-->
                <div class="w-1/1 | bg-black bg-opacity-30 | flex flex-wrap">

                    <div class="w-1/1 sm:w-3/12 | mt-5 sm:mt-10">
                        <div class="m-4">
                            <img src="{{asset($image)}}" alt="">
                        </div>
                    </div>

                    <div class="w-1/1 sm:w-9/12 | mt-5 sm:mt-10 | flex flex-col | text-white">
                        <div>
                            <p class="font-bold text-3xl">{{$user->username}}</p>
                        </div>
                        <div class="my-5">
                            <p>Descripcion personal de: {{$user->name}} {{$user->surname}}</p>
                        </div>
                    </div>

                </div>

                <!-- Body -->
                <div class="flex flex-wrap | w-1/1">
                    <div class="flex flex-wrap | w-full sm:w-9/12 | px:2 sm:px-5 | bg-black bg-opacity-30">
                        @if (count($novels)==0)
                            No hay novelas disponibles
                        @else
                            <div class="flex flex-wrap | w-full | mt-5 | p-2 | bg-black bg-opacity-30">
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
                        @endif
                    </div>

                    <div class="flex flex-wrap | w-full sm:w-3/12 | px:2 sm:px-10 | bg-black bg-opacity-30">
                        <div class="flex flex-wrap | w-full | mt-5 | p-2 | bg-white bg-opacity-30">
                            enlaces persoanles
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </body>

</html>