<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('goLibraryResult')}}" method="post">
        @csrf
        <div>
            <input type="text" name="type" hidden value="{{$type}}">
            <input type="text" name="searcher" placeholder="Buscar...">
            <input type="submit" valie="Buscar">
        </div>
        <div>
            <div>
                <label for="order">Order</label>
                <select name="order" id="order">
                    <option value="desc">Más nuevos</option>
                    <option value="asc">Más viejos</option>
                    <option value="more">Más capitulos</option>
                    <option value="minus">Menos capitulos</option>
                    <option value="alfa">Alfabetico</option>
                    <option value="alfaC">Contrario al alfabetico</option>
                </select>
                <div>
                <label for="both">Ambos</label>
                <input type="checkbox" name="both" value="both">:
                <label for="adult_content">+18</label>
                <input type="checkbox" name="adult_content" value="0">
                </div>
            </div>
            <!--VisualNovel type-->
            @if($type == 1)
                <div>
                    <label for="all">Todos</label>
                    <input type="checkbox" name="all" value="all">:
                    <label for="manhua">Manhwa</label>
                    <input type="checkbox" name="manhua" value="manhua">
                    <label for="manhua">Manhua</label>
                    <input type="checkbox" name="manhua" value="manhua">
                    <label for="manga">Manga</label>
                    <input type="checkbox" name="manga" value="manga">
                    <label for="one_shot">Manga</label>
                    <input type="checkbox" name="one_shot" value="oneShot">
                </div>
            @endif
            <div>
                <label for="markOrder">Nota:</label>
                <select name="markOrder" id="markOrder">
                    <option value="mas">Mayor</option>
                    <option value="men">Menor</option>
                </select>
                <input type="number" name="mark" value="0" min="0" min="10">
            </div>

        </div>
    </form>
    <div>
        @if($results[0]->name != null)
            <table border="1">
                <tr>
                    <th colspan="2">
                        SEARCH RESULT
                    </th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Capitulos</th>    
                </tr>
                @foreach($results as $result)
                    <tr style="text-align:center;">
                        <td>{{$result->name}}</td>
                        <td>{{$result->chapters_count}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        <table border="1">
            <tr>
                <th colspan="2">
                    LAST CONTENT
                </th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Capitulos</th>    
            </tr>
            @foreach($novels as $novel)
            <tr style="text-align:center;">
                <td>{{$novel->name}}</td>
                <td>{{$novel->chapters_count}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>