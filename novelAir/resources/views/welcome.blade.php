<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen""> 
            <!--@@include('layouts.navigationNew')-->
        <div class="flex justify-center | w-full">

            <!--Main novel-->
            <div class="w-1/1 sm:w-11/12 | bg-black bg-opacity-30">

                <div class="flex | w-full">
                    <p class="text-white text-lg">CARROUSEL O ALGO</p>
                </div>

                <div class="flex flex-col | w-full">
                    <div class="w-1/1">
                        <p class="text-white font-bold">LAS NOVELAS MÁS VISTAS ESTA SEMANA</p>
                    </div>
                    <div class="flex justify-around| w-full">  
                        <div class="w-1/2 | show-visual | bg-ourBlue | border-2">
                            <p class="text-white text-center font-bold">VISUAL NOVELS</p>
                        </div> 
                        <div class="w-1/2 | show-novel | bg-ourBlue | border-2">
                            <p class="text-white text-center font-bold">NOVELAS</p>
                        </div>
                    </div>
                    <!--Populares VisualNovels-->
                    <div class="visual flex flex-col | w-full">
                        <div class="flex flex-wrap">
                            @foreach($visual_novels as $novel)
                                <a class="w-4/12 sm:w-2/12 " href="{{url('novel/'.$novel->id)}}">
                                        
                                    <div class="flex flex-col | h-44 lg:h-52 xl:h-80 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                                        <div class=" w-full | h-full">

                                            <div class="w-full">
                                                
                                                <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$novel->name}}</p>

                                            </div>

                                            <div class="w-1/1 | flex justify-between | |">
                                                
                                                <p class="bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                                <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>

                                            </div>
                                            
                                        </div>
                                    
                                        <div class="w-full">
                                            
                                            <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                                @foreach($genres as $genre) @if($genre->id == $novel->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                            </p>

                                        </div>
                                    </div>

                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!--Populares Novels-->
                    <div class="novel hidden flex flex-col | w-full">
                        <div class="flex flex-wrap">
                            @foreach($novels as $novel)
                                <a class="w-4/12 sm:w-2/12" href="{{url('novel/'.$novel->id)}}">
                                        
                                    <div class="flex flex-col | h-44 lg:h-52 xl:h-80 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                                        <div class=" w-full | h-full">

                                            <div class="w-full">
                                                
                                                <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$novel->name}}</p>

                                            </div>

                                            <div class="w-1/1 | flex justify-between | |">
                                                
                                                <p class="bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                                <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>

                                            </div>
                                            
                                        </div>
                                    
                                        <div class="w-full">
                                            
                                            <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                                @foreach($genres as $genre) @if($genre->id == $novel->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                            </p>

                                        </div>
                                    </div>

                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--Populares Users-->
                <div class="flex flex-col | w-full">
                    <div class="w-1/1">
                        <p class="text-white font-bold">LOS USUARIOS MÁS POPULARES DE ESTA SEMANA</p>
                    </div>
                    <div class="flex flex-wrap | w-1/1">
                        @foreach($users as $user)
                            <div class="w-4/12 sm:w-2/12">
                                <div class="m-2">
                                    <a href="{{url('perfil/'.$user->id.'/'.$user->username)}}">   
                                        <div class="bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset('users/'.$user->id.'/profile/bgImage'.$user->imgtype)}}');">
                                            <div class="w-full | h-full | bg-black bg-opacity-60">
                                                <div class="mx-auto py-3 | justify-items-center">
                                                    <img class="mx-auto | rounded-full" width="50%" 
                                                    @if(file_exists(public_path() ."/users/". $user->id ."/profile/usericon". $user->imgtype))
                                                        src="{{asset("/users/". $user->id ."/profile/usericon". $user->imgtype)}}"
                                                    @else
                                                        src="{{asset("/images/noimage.png")}}"
                                                    @endif
                                                    alt="">
                                                </div>
                                                <div class="w-full">
                                                    <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$user->username}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <!--Ultimas Novels-->
                <div class="flex flex-col | w-full">
                    <div class="w-1/1">
                        <p class="text-white font-bold">ULTIMAS NOVELAS PUBLICADAS</p>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach($last_novels as $novel)
                            <a class="w-4/12 sm:w-2/12" href="{{url('novel/'.$novel->id)}}">
                                    
                                <div class="flex flex-col | h-44 lg:h-52 xl:h-80 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                                    <div class=" w-full | h-full">

                                        <div class="w-full">
                                            
                                            <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$novel->name}}</p>

                                        </div>

                                        <div class="w-1/1 | flex justify-between | |">
                                            
                                            <p class="bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                            <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>

                                        </div>
                                        
                                    </div>
                                
                                    <div class="w-full">
                                        
                                        <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                            @foreach($genres as $genre) @if($genre->id == $novel->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                        </p>

                                    </div>
                                </div>

                            </a>
                        @endforeach
                    </div>
                </div>
                <!--Mejores Novels-->
                <div class="flex flex-col | w-full">
                    <div class="w-1/1">
                        <p class="text-white font-bold">LO MEJOR DE NOVEL AIR</p>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach($best as $novel)
                            <a class="w-4/12 sm:w-2/12" href="{{url('novel/'.$novel->id)}}">
                                    
                                <div class="flex flex-col | h-44 lg:h-52 xl:h-80 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                                    <div class=" w-full | h-full">

                                        <div class="w-full">
                                            
                                            <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$novel->name}}</p>

                                        </div>

                                        <div class="w-1/1 | flex justify-between | |">
                                            
                                            <p class="bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                            <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>

                                        </div>
                                        
                                    </div>
                                
                                    <div class="w-full">
                                        
                                        <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                            @foreach($genres as $genre) @if($genre->id == $novel->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                        </p>

                                    </div>
                                </div>

                            </a>
                        @endforeach
                    </div>
                </div>


                
            </div>
            <script>
                $(document).ready(()=>{ 
                    $('.show-novel').click(function(){
                        $('.novel').show();
                        $(this).removeClass('bg-ourBlue').addClass('bg-blue-800');
                        $('.visual').hide(); 
                        $('.show-visual').removeClass('bg-blue-800').addClass('bg-ourBlue');
                    });
                    $('.show-visual').click(function(){
                        $('.novel').hide();
                        $('.show-novel').removeClass('bg-blue-800').addClass('bg-ourBlue');
                        $('.visual').show(); 
                        $(this).removeClass('bg-ourBlue').addClass('bg-blue-800');
                    });
                })
            </script>
    </body>
</html>
