<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="route" content="{{ $chapter[0]->route }}">
    <meta name="chapter_id" content="{{ $chapter[0]->id }}">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <a href="{{url('novel_manager')}}/{{$novel[0]->id}}/{{$chapter[0]->id}}"><button>BACK</button></a>
    <center style="margin-top:200px;">
    <form action="{{route('addImages')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Contenido del capitulo(".jpg",".png"):</label>
        <input hidden type="text" name="route" value="{{$chapter[0]->route}}" id="route">
        <input hidden type="text" name="novel_id" value="{{$novel[0]->id}}" id="novel_id">
        <input hidden type="text" name="id" value="{{$chapter[0]->id}}" id="id">
        <input multiple type="file" accept="image/jpg,image/jpeg,image/png" name="content[]" id="content"><br><br>
        <input type="submit" value="AÑADIR">
    </form>
        <div class="img-container" style=" margin-top:10px;width:1100px; border:1px solid;">
            <ul id="image-list" style="display:flex; list-style:none; width:1100px;">
                @foreach ($content as $c)
                    <li class="transferable" style="">
                        <a hidden class="code" >{{$c->getFilename()}}</a>
                        <img class="contentImg draggable" width="200px" height="250px"  src="{{url($chapter[0]->route)}}{{'/'.$c->getFilename()}}"><br>
                        <a class="toEliminate" style="background-color:red;width:50px;"><button>X</button></a>
                    </li>
                @endforeach
            </ul>
        </div>
        <h4 class="amount">Image amount: </h4>
        <!--href="{{url('novel_manager')}}/{{$novel[0]->id}}/{{$chapter[0]->id}}"-->
        <a id="finish" ><button>SAVE</button></a>
    </center>
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
                $("#image-list").sortable({
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
                    url: "https://dawjavi.insjoaquimmir.cat/jfuentes/novelAir/public/novel_manager/editImages",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        window.location.href = "https://dawjavi.insjoaquimmir.cat/jfuentes/novelAir/public/novel_manager/{{$novel[0]->id}}/{{$chapter[0]->id}}";

                    }
                });
            }
        })
    </script>
</body>
</html>