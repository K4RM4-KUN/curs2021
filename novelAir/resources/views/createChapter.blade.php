<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <form action="{{route('createChapters')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" value="{{$novels[0]->id}}" id="id"><br><br>
            <input type="text" name="novel_dir" value="{{$novels[0]->novel_dir}}" id="novel_dir"><br><br>
            <label for="title">Titulo:</label><br>
            <input type="text" name="title" id="title"><br><br>
            <label for="chapter_n">Numero de capitulo:</label><br>
            <input type="number" name="chapter_n" id="chapter_n"><br><br>
            <label for="title">Contenido del capitulo(".jpg",".png",".svg"):</label><br>
            <input multiple type="file" accept="image/jpg,image/jpeg,image/png,image/svg" name="content[]" id="content"><br><br>
            <input type="submit" value="SEND">
        </form>
    </center>
</body>
</html>