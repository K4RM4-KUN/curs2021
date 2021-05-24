<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- PHP -->
        <?php 
            $x = 0;
            foreach ($chapters as $ch){
                if ($ch == $chapter[0]){
                    $chapterIndex = $x;
                }
                $x++;
            }
        ?>
    </head>




    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen container mx-auto min-h-screen">

        <div class="flex flex-col">

            <div class="bg-gradient-to-l from-blue-700 to-blue-500 border-b border-gray-300 pt-3 rounded-t w-1/1 mx-0 sm:mx-2 xl:mx-44 flex flex-col">
                <div class="flex">
                    <div class="flex-1 text-center">
                        <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{url('novel_manager')}}/{{$novel[0]->id}}">BACK</a>
                    </div>

                    <div class="flex-1 text-center">
                        <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('goVC',['id'=>$novel[0]->id,'chapter'=>$chapter[0]->id])}}">EDITAR</a>
                    </div>
                </div>
                <div class="flex mt-8 sm:mt-4 text-white">
                    <div class="w-3/12 flex justify-center content-center">
                        <div class="text-center">
                        <a
                            @if ($chapter[0]->chapter_n != $chapters[count($chapters)-1]->chapter_n)
                                @if ($chapter[0]->chapter_n-1 <= $chapters[$chapterIndex+1]->chapter_n)
                                    href="{{url('novel_manager/viewChapter')}}/{{$novel[0]->id}}/{{$chapters[$chapterIndex+1]->chapter_n}}"
                                @else <?$y=0?>
                                @endif
                            @else <?$y=0?>
                            @endif
                        ><button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md @if(isset($y)) bg-yellow-300 @else bg-gradient-to-r from-yellow-400 to-yellow-600 transform hover:scale-110 @endif">
                            <div class="hidden sm:block">Cap. Anterior</div>
                        </button></a>
                        </div>
                    </div>
                    <div class="w-6/12">
                        <div class="text-center text-xl text-white">{{$novel[0]->name}}</div><div class="text-center text-white"> capitulo {{$chapter[0]->chapter_n}}</div>
                    </div>
                    <div class="w-3/12 flex justify-center content-center mb-3">
                        <div class="text-center">
                        <a @if (($chapter[0]->chapter_n != $chapters[0]->chapter_n)) 
                            @if ($chapter[0]->chapter_n+1 >= $chapters[$chapterIndex-1]->chapter_n)
                                href="{{url('novel_manager/viewChapter')}}/{{$novel[0]->id}}/{{$chapters[$chapterIndex-1]->chapter_n}}"
                            @else <?$z=0?>
                            @endif
                        @else <?$z=0?>
                        @endif
                        ><button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md @if(isset($z)) bg-yellow-300 @else bg-gradient-to-r from-yellow-400 to-yellow-600 transform hover:scale-110 @endif">
                            <div class="hidden sm:block">Cap. Siguiente</div>
                        </button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded shadow w-1/1 mx-0 sm:mx-2 xl:mx-44">
                @foreach ($content as $c)
                    <img class="w-full" src="{{url($chapter[0]->route)}}{{'/'.$c->getFilename()}}">
                @endforeach
            </div>

            <div class="bg-gradient-to-l from-blue-700 to-blue-500 border-t border-gray-300 pt-3 rounded-b w-1/1 mx-0 sm:mx-2 xl:mx-44 mb-5 flex flex-col">
                <div class="flex text-white">
                    <div class="w-3/12 flex justify-center content-center">
                        <div class="text-center">
                        <a
                            @if ($chapter[0]->chapter_n != $chapters[count($chapters)-1]->chapter_n)
                                @if ($chapter[0]->chapter_n-1 <= $chapters[$chapterIndex+1]->chapter_n)
                                    href="{{url('novel_manager/viewChapter')}}/{{$novel[0]->id}}/{{$chapters[$chapterIndex+1]->chapter_n}}"
                                @else <?$y=0?>
                                @endif
                            @else <?$y=0?>
                            @endif
                        ><button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md @if(isset($y)) bg-yellow-300 @else bg-gradient-to-r from-yellow-400 to-yellow-600 transform hover:scale-110 @endif">
                            <div class="hidden sm:block">Cap. Anterior</div>
                        </button></a>
                        </div>
                    </div>
                    <div class="w-6/12">
                        <div class="text-center text-xl text-white">{{$novel[0]->name}}</div><div class="text-center text-white"> capitulo {{$chapter[0]->chapter_n}}</div>
                    </div>
                    <div class="w-3/12 flex justify-center content-center">
                        <div class="text-center">
                        <a @if (($chapter[0]->chapter_n != $chapters[0]->chapter_n)) 
                            @if ($chapter[0]->chapter_n+1 >= $chapters[$chapterIndex-1]->chapter_n)
                                href="{{url('novel_manager/viewChapter')}}/{{$novel[0]->id}}/{{$chapters[$chapterIndex-1]->chapter_n}}"
                            @else <?$z=0?>
                            @endif
                        @else <?$z=0?>
                        @endif
                        ><button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md @if(isset($z)) bg-yellow-300 @else bg-gradient-to-r from-yellow-400 to-yellow-600 transform hover:scale-110 @endif">
                            <div class="hidden sm:block">Cap. Siguiente</div>
                        </button></a>
                        </div>
                    </div>
                </div>
                <div class="flex mb-4 mt-8 sm:mt-4">
                    <div class="flex-1 text-center">
                        <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{url('novel_manager')}}/{{$novel[0]->id}}">BACK</a>
                    </div>

                    <div class="flex-1 text-center">
                        <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('goVC',['id'=>$novel[0]->id,'chapter'=>$chapter[0]->id])}}">EDITAR</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>