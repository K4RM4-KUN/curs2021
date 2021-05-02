<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ $chapter[0]->route }}">
        <meta name="chapter_id" content="{{ $chapter[0]->id }}">

        <title>Novel Manager</title>

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

    <!-- Body: Tailwind el "bg" funciona raro, no llena toda la pantalla -->
    <body class="bg-gradient-to-br from-gray-700 to-gray-800 container mx-auto min-h-screen">

        <!-- Pequeño page history: Solo habra un boton de "BACK" -->
        <div class="container mt-5">

            <!-- Boton back -->
            <a class="text-l shadow text-black font-bold bg-white p-2 py-1 rounded" href="{{url('novel_manager')}}/{{$novel[0]->id}}/{{$chapter[0]->id}}">BACK</a>

        </div>

        <!-- Grid(5x2): Grid que contiene las novelas del usuario. -->
        <div class="grid grid-cols-1 gap-x-5 my-5">
        
            <!-- Seccion Novelas: Contiene todas las novelas del usuario -->
            <!-- Por hacer seccion interaccion -->
            <div class="bg-white shadow rounded col-span-3 row-span-2">

                <div class="border-b border-gray-300 bg-gradient-to-l from-blue-700 to-blue-500 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Imagenes del capitulo -- {{$chapter[0]->chapter_n.". ".$chapter[0]->title}} --</p>

                </div>

                <div class="my-5 border-b border-gray-300 mx-5">

                    <p class="hidden text-xl text-center mb-3">Añade más imagenes(".jpg",".png")</p>
                    
                    <div class="form">

                        <form action="@{{route('addImages')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="hidden">

                                <input hidden type="text" name="route" value="{{$chapter[0]->route}}" id="route">
                                <input hidden type="text" name="novel_id" value="{{$novel[0]->id}}" id="novel_id">
                                <input hidden type="text" name="id" value="{{$chapter[0]->id}}" id="id">

                            </div>

                            <div class="flex items-center justify-center">
                                <div class="flex w-full justify-center bg-grey-lighter">
                                        <input class=""
                                        
                                        multiple 
                                        type="file" 
                                        accept="image/jpg,image/jpeg,image/png" 
                                        name="content[]" 
                                        id="content">
                                </div>

                            </div>

                            <div class="flex items-center justify-center my-3">

                                <input class="bg-white text-blue-500 hover:text-blue-700 hover:shadow hover:bg-blue-100 font-bold py-2 px-4" 
                                type="submit"
                                value="Añadir imagenes">

                            </div>

                        </form>

                    </div>

                </div>

                <ul id="image-list">

                    <div class="grid gap-x-2 grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 border-b border-gray-300 mx-5">
                    
                        @foreach ($content as $c)

                            <li class="bg-blue-100 transferable shadow-xl border-2 border-blue-100 mb-5">
                                    
                                    <p class="code text-center mr-2 my-2">{{$c->getFilename()}}</p>

                                    <img class="contentImg" src="{{url($chapter[0]->route)}}{{'/'.$c->getFilename()}}" alt="{{$c->getFilename()}}   ">

                                    <a class="toEliminate flex items-center justify-center mr-2 my-2">

                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold rounded px-2 p-0.5" >X</button>

                                    </a>

                            </li>

                        @endforeach

                    </div>

                </ul>

                <div class="my-5">

                    <p class="amount text-blue-400 text-center">Image amount: 0</p>
                    
                    <div class="flex items-center justify-center py-5">

                        <a id="finish">
                        
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold rounded px-2 p-0.5" >GUARDAR</button>
                        
                        </a>

                    </div>

                </div>
                
            </div>  

        </div>

    <script>
        $(document).ready(()=>{
            $(".amount").text("Image amount: "+$(".contentImg").length)
            let toEliminate = [];
            $(".transferable .toEliminate").click(function(){
                toEliminate.push($(this).parent().children('.code').text())
                $(this).parent().remove()
                console.log(toEliminate)
                $(".amount").text("Image amount: "+$(".contentImg").length)
            })

            //sortable: https://api.jqueryui.com/sortable/#theming
            $( function() {
                $("#image-list").children().sortable({
                    connectWith: ".transferable"
                }).disableSelection();
            } );

            $("#finish").click(function(){
                let prepareNum = [];
                let prepareId = [];
                $(".transferable .code").each(function(){
                    prepareNum.push($(this).text())
                })
                console.log(prepareNum,toEliminate);
                newImages(prepareNum,toEliminate);
            })

            function newImages(toUpdateNum,toEliminate){
                event.preventDefault();
                let data = new FormData();
                data.append("_token", $('meta[name=csrf-token]').attr('content'));
                data.append("toUpdateNum",toUpdateNum);
                data.append("toEliminate",toEliminate);
                data.append("route", $('meta[name=route]').attr('content'));
                data.append("chapter_id", $('meta[name=chapter_id]').attr('content'));
                $.ajax({
                    type: "POST",
                    url: "{{url('novel_manager/editImages')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        location.reload(true)
                        //window.location.href = "{{url('novel_manager')}}/{{$novel[0]->id}}/{{$chapter[0]->id}}";
                    }
                });
            } 
        })
    </script>

    </body>
    
</html>
