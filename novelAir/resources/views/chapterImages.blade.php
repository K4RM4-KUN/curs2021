<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <a href="{{url('novel_manager')}}/{{$novel[0]->id}}}"><button>BACK</button></a>
    <center style="margin-top:200px;">
    <a href="{{url('novel_manager')}}/{{$novel[0]->id}}/{{$chapter[0]->id}}"><button>OK</button></a>
        <div style="margin-top:10px;width:1010px; border:1px solid;">
            @foreach ($content as $c)
                <img class="contentImg" width="200px" height="200px" src="{{url($chapter[0]->route)}}{{'/'.$c->name.'.'.$c->img_type}}">
            @endforeach
        </div>
        <h4 class="amount">Image amount: </h4>
    </center>
    <script>
        $(document).ready(()=>{
            var imgAmount = 0;
            $(".contentImg").foreach(function(){
                imgAmount += 1;
            })
            $(".amount").text("Image amount: "+imgAmount)
        })
    </script>
</body>
</html>