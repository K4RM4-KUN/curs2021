<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NovelAir</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
        body{
            user-select:none;
        }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    </head>
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen"> 
    
        @include('layouts.navigationNew')<!--NavBar-->
        <!-- @include('cookieConsent::index') --><!--Cookies-->

        <div class="flex flex-col justify-center items-center | w-full |">

            <!--Carrousel Container-->
            <div class="flex | w-full | bg-fixed" style="background-image:url({{asset('images/bg-show.jpg')}});">

                <div class="flex justify-center items-center | w-11/12 | my-5 mx-auto">
                    <div id="left" class="flex justify-center items-center | rounded-l-xl | bg-gray-200 bg-opacity-60 hover:bg-opacity-80 shadow-xl | px-2 sm:px-4 m mx-2 | w-1/8 h-full">
                        <p class="text-3xl text-gray-600"><</p>
                    </div>
                    <div>
                        <img id="cover" class="4/8" src="{{asset('images/homeShow/1.png')}}" alt="">
                    </div>
                    <div id="right" class="flex justify-center items-center | rounded-r-xl | bg-gray-200 bg-opacity-60 hover:bg-opacity-80 shadow-xl | px-2 sm:px-4 mx-2 | w-1/8 h-full">
                        <p class="text-3xl text-gray-600">></p>
                    </div>
                </div>
            </div> 
            <div class="flex | w-full h-2 | bg-white bg-opacity-80">
            </div>

            <!--Popular VisualNovels/Novels Titles-->
            <div class="flex | w-11/12 | bg-black bg-opacity-70">
                <p class="text-xl sm:text-2xl font-bold text-ourBlue | px-5 py-3">Popular</p>
            </div> 

            <!--Popular VisualNovels/Novels buttons-->
            <div class="flex justify-around | w-11/12 | bg-black bg-opacity-70 | mx-4">  
                <div class="flex justify-center items-center | w-1/2 | show-visual | bg-blue-700 | border-l-2 border-t-2 border-b-2">
                    <p class="text-white text-xs sm:text-base text-center font-bold">VISUAL NOVELS</p>
                </div> 
                <div class="flex justify-center items-center | w-1/2 | show-novel | bg-ourBlue | border-r-2 border-t-2 border-b-2 ">
                    <p class="text-white text-xs sm:text-base text-center font-bold">NOVELAS</p>
                </div>
            </div>

            <!--Popular VisualNovels/Novels Content-->
            <div class="visual flex flex-wrap | w-11/12 | py-1 | bg-black bg-opacity-50">
                @foreach($visual_novels as $novel)
                    <a class="w-2/6 sm:w-1/6 " href="{{url('novel/'.$novel->id)}}">
                        <div class="flex flex-col justify-between | h-48 sm:h-40 md:h-52 lg:h-64 xl:h-72 | m-1 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                            <div class="flex justify-between | bg-black bg-opacity-0">
                                <p class="block | bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                <p class="hidden md:block bg-black bg-opacity-70 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>
                            </div>
                            <div class="flex | bg-black bg-opacity-70">
                                <p class="text-white text-xs sm:text-base font-bold | px-2 py-1 | truncate">{{ucfirst($novel->name)}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div> 
            <div class="novel flex flex-wrap | w-11/12 | py-1 | bg-black bg-opacity-50">
                @foreach($novels as $novel)
                    <a class="w-2/6 sm:w-1/6 " href="{{url('novel/'.$novel->id)}}">
                        <div class="flex flex-col justify-between | h-48 sm:h-40 md:h-52 lg:h-64 xl:h-72 | m-1 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                            <div class="flex justify-between | bg-black bg-opacity-0">
                                <p class="block | bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                <p class="hidden md:block bg-black bg-opacity-70 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>
                            </div>
                            <div class="flex | bg-black bg-opacity-70">
                                <p class="text-white text-xs sm:text-base font-bold | px-2 py-1 | truncate">{{ucfirst($novel->name)}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!--Popular Users-->
            <div class="flex | w-11/12 | bg-black bg-opacity-70">
                <p class="text-xl sm:text-2xl font-bold text-ourBlue | px-5 py-3">Usuarios populares</p>
            </div> 
            <div class="flex flex-row flex-wrap md:flex-nowrap justify-center items-center | w-11/12 | py-1 | bg-black bg-opacity-50">
                @foreach($users as $user)
                    <a class="m-2 | w-2/6 md:w-1/6 | bg-black bg-opacity-70 " href="{{url('perfil/'.$user->id.'/'.$user->username)}}">   
                        <div class="flex flex-col justify-between | | w-1/1 h-32 sm:h-40 md:h-48 lg:h-48 xl:h-64 | m-1 | bg-cover bg-no-repeat bg-center" style="background-image:url( 
                            @if(file_exists(public_path() ."/users/". $user->id ."/profile/usericon". $user->imgtype))
                                '{{asset("/users/". $user->id ."/profile/usericon". $user->imgtype)}}'
                            @else
                                '{{asset("/images/noimage.png")}}'
                            @endif
                            );">
                            <div class="flex | bg-black bg-opacity-70">
                            </div>
                            <div class="flex | bg-black bg-opacity-70">
                                <p class="text-white text-center text-sm font-bold | px-2 py-1 | truncate">{{$user->username}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div> 

            <!--Mejores Novelas-->
            <div class="flex | w-11/12 | bg-black bg-opacity-70">
                <p class="text-xl sm:text-2xl font-bold text-ourBlue | px-5 py-3">Mejores</p>
            </div> 
            <div class="flex flex-wrap | w-11/12 | py-1 | bg-black bg-opacity-50">
                @foreach($best as $novel)
                    <a class="w-2/6 sm:w-1/6 " href="{{url('novel/'.$novel->id)}}">
                        <div class="flex flex-col justify-between | h-48 sm:h-40 md:h-52 lg:h-64 xl:h-72 | m-1 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                            <div class="flex justify-between | bg-black bg-opacity-0">
                                <p class="block | bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                <p class="block bg-black bg-opacity-70 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>
                            </div>
                            <div class="flex | bg-black bg-opacity-70">
                                <p class="text-white text-xs sm:text-base font-bold | px-2 py-1 | truncate">{{ucfirst($novel->name)}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div> 

            <!--Ultimas Novelas-->
            <div class="flex | w-11/12 | bg-black bg-opacity-70">
                <p class="text-xl sm:text-2xl font-bold text-ourBlue | px-5 py-3">Últimas Añadidas</p>
            </div> 
            <div class="flex flex-wrap | w-11/12 | py-1 | bg-black bg-opacity-50">
                @foreach($last_novels as $novel)
                    <a class="w-2/6 sm:w-1/6 " href="{{url('novel/'.$novel->id)}}">
                        <div class="flex flex-col justify-between | h-48 sm:h-40 md:h-52 lg:h-64 xl:h-72 | m-1 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}');">
                            <div class="flex justify-between | bg-black bg-opacity-0">
                                <p class="block | bg-{{$novel->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($novel->novel_type)}}</p>
                                <p class="hidden md:block bg-black bg-opacity-70 | px-1 py-0.5 | text-xs text-white font-bold">{{$novel->mark}}/10</p>
                            </div>
                            <div class="flex | bg-black bg-opacity-70">
                                <p class="text-white text-xs sm:text-base font-bold | px-2 py-1 | truncate">{{ucfirst($novel->name)}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div> 
            
        </div>

        @include('layouts.footer')<!--Footer-->

        <script>
            $(document).ready(()=>{ 
                let coverImages = parseInt("{{$covers}}");
                let actual = 1;
                let imageInfo = [
                    @foreach($imgData as $img)
                        '{{asset("images/homeShow/".$img->getFilename())}}'@if(!$loop->last),@endif
                    @endforeach

                ];

                if(coverImages > 1){
                    $('#right').removeClass('bg-white').removeClass('text-gray-700').addClass('bg-black').addClass('text-white');
                } 

                $('.show-novel').click(function(){
                    $('.novel').show();
                    $(this).removeClass('bg-ourBlue').addClass('bg-blue-700');
                    $('.visual').hide(); 
                    $('.show-visual').removeClass('bg-blue-700').addClass('bg-ourBlue');
                });
                $('.show-visual').click(function(){
                    $('.novel').hide();
                    $('.show-novel').removeClass('bg-blue-700').addClass('bg-ourBlue');
                    $('.visual').show(); 
                    $(this).removeClass('bg-ourBlue').addClass('bg-blue-700');
                });;

                $('#left').click(function(){
                    if(actual-1 >= 1){
                        actual-=1;
                        $("#cover").attr("src",imageInfo[actual-1]);
                    }
                });
                $('#right').click(function(){
                    if(actual+1 <= coverImages){
                        actual+=1;
                        $("#cover").attr("src",imageInfo[actual-1]);
                    }
                });
            })
        </script>

    </body>
</html>
