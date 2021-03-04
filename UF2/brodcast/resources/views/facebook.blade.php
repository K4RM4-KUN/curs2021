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
            height:120px;
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

            <div id="walls">
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
                    </div>
                @endforeach
            </div>

            <div class="input">
                <form action="{{ Route('sendPost')}}" method="post" id="messageSend">
                    <label for="message">Your post: </label><input type="text" name="message" id="message" >
                    <input type="submit" id="send" value="Send">
                    <select name="userTo" id="channel" hidden>
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