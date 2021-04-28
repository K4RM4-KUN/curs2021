<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <a href="{{url('novel_manager')}}/{{$novel[0]->id}}}"><button>BACK</button></a>
    <center style="margin-top:200px;">
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Contenido del capitulo(".jpg",".png"):</label>
        <input multiple type="file" accept="image/jpg,image/jpeg,image/png" name="content[]" id="content"><br><br>
        <input type="submit" value="AÑADIR">
    </form>
        <div class="img-container" style=" margin-top:10px;width:1010px; border:1px solid;">
            <ul id="image-list" style="display:flex; list-style:none;">
                @foreach ($content as $c)
                <li style="">
                    <a hidden>{{$c->name}}</a>
                    <img class="contentImg draggable" width="200px" height="200px" src="{{url($chapter[0]->route)}}{{'/'.$c->name.'.'.$c->img_type}}">
                </li>
                @endforeach
            </ul>
        </div>
        <h4 class="amount">Image amount: </h4>
        <a href="{{url('novel_manager')}}/{{$novel[0]->id}}/{{$chapter[0]->id}}"><button>OK</button></a>
    </center>
    <script>
        $(document).ready(()=>{
            $(".amount").text("Image amount: "+$(".contentImg").length)
            //sortable: https://api.jqueryui.com/sortable/#theming
            $( function() {
                $("#image-list, #chart").sortable({
                    connectWith: ".transferable"
                }).disableSelection();
            } );
        })
    </script>
</body>
</html>