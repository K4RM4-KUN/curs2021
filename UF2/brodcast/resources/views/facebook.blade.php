<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FakeBook</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" user-id="{{ $user_id }}" user-name="{{$user_name[0]->name}}" src="{{ asset('js/functions.js') }}" defer></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
    <style>
        body{
            background-color: #2d2d2d;
            color: white;
        }
        .input{
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 100px;
            background-color: #424242;
        }
        #messageSend{
            margin-top: 35px;
        }
        .wallBlock{
            border: 1px solid white;
            margin: 20px auto;
            width: 25%;
            background-color: #585858;
            width: 50%;
        }
        .wallBlock:last-child{
            margin-bottom: 120px;
        }
        .typing{
            display: none;
        }
        .headFB{
            margin-right: 15%;
            height:120px;
        }
        .buttonComment{
            margin: 5px;
        }
        .buttonCommentGo{
            margin: 5px;
        }
        .buttonLike{
            margin: 5px;
        }
        .X{
            margin: 5px;
        }
        #walls{
            width:85%;
        }
        #connecteds{
            float: right;
            position: fixed;
            width: 15%;
            height: 1000px;
            bottom: 0;
            left: 85%;
            background-color: #424242;
        }
    </style>
</head>
    <body> 
        <center>
            <div class="headFB">
                <h1>FAKEBOOK</h1>
                <h4>Welcome {{$user_name[0]->name}}!</h4>
                <h5 class="typing"> Alguien esta escribiendo </h5>
            </div>
        </center>
        <div style="width: 100%;">
            <div id="connecteds">
                <center>
                    <h3>Connected users</h3>
                    <h4 style="margin-bottom: 25px;margin-top:-25px;">-------------------</h4>
                </center>
            </div>
            <div id="walls">
                <center>
                        @foreach ($old as $mess)
                            <div class="wallBlock">
                                @if ($mess->from == $user_id)
                                    <p>You: {{$mess->message}}</p>
                                @else
                                    @foreach($users as $user)
                                        @if($mess->from == $user->id)
                                            <p>{{$user->name}}: {{$mess->message}}</p>
                                        @endif
                                    @endforeach
                                @endif
                                <input type="text" class="postId" value="{{$mess->id}}" hidden>
                                <input class="buttonLike" type="button" value="{{$mess->likes_count}} Like" >
                                <input class="buttonComment" type="button" value="Show Comments" >
                                <div class="comments" hidden>
                                    <input type="text" class="comm" placeholder="Comment...">
                                    <input class="buttonCommentGo" type="button" value="Comment">
                                    @foreach($mess->comments as $comment)
                                        <div>
                                            @if ($comment->user_id == $user_id)
                                                <p>You: {{$comment->comment}}</p>
                                            @else
                                                @foreach($users as $user)
                                                    @if($comment->user_id == $user->id)
                                                        <p>{{$user->name}}: {{$comment->comment}}</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                </center>
            </div>
        </div>
        <center>
            <div class="input">
                <form action="{{ Route('sendPost')}}" method="post" id="messageSend" style="margin-right: 15%;">
                    <label for="message">Your post: </label><input type="text" name="message" id="message" >
                    <input type="file" name="image" id="imageUp" >
                    <input type="submit" id="send" value="Send">
                    <select name="userTo" id="channel">
                                <option value="_public_channel_">Public channel</option>
                        @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </center>
    </body>
</html>