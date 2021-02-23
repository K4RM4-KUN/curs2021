<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FakeBook</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" user-id="{{ $user_id }}" src="{{ asset('js/functions.js') }}" defer></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
</head>
    <body> 
        <center>
            <h1>WELCOME TO FAKEBOOK</h1>
            <h2>we don't like real things</h2>
            <h4>i really hate them</h4>

            <div id="walls">
                @foreach ($old as $message)
                    <p>{{$message->message}}</p>
                @endforeach
            </div>
        </center>
    </body>
</html>