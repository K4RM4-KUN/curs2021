<!-- https://programadorwebvalencia.com/sencillo-boton-on-off-html-y-css/ -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" src="{{ asset('js/createNovelJS.js') }}" defer></script>
</head>
<body>
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <a href="{{ url()->previous() }}">BACK</a>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('insertNovel') }}">
            @csrf
            
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Genre -->
            <div>
                <x-label for="genre" :value="__('Genero')" />

                <x-input id="genre" class="block mt-1 w-full" type="text" name="genre" :value="old('genre')" required autofocus />
            </div>

            <!-- Sinopsis -->
            <div class="mt-4">
                <x-label for="sinopsis" :value="__('Sinopsis')" />

                <x-input id="sinopsis" class="block mt-1 w-full" type="text" name="sinopsis" :value="old('sinopsis')" required />
            </div>

            <!-- Tags -->
            <div class="mt-4">
                <x-label for="tags" :value="__('Tags')" />

                <x-input id="tags" class="block mt-1 w-full" type="text" name="tags" :value="old('tags')" placeholder="accion,aventura,romance..." />
            </div>

            <!-- AdultContent -->
            <div class="mt-4">
                <x-label for="adultContent" :value="__('+18')" />

                <x-input id="adultContent" class="block mt-1 w-full" type="checkbox" name="adultContent" :value="old('adultContent')" />
            </div>


            <!-- VisualNovel -->
            <div class="mt-4">
                <x-label for="visualNovel" :value="__('Visual Novel')" />

                <x-input id="visualNovel" class="block mt-1 w-full" type="checkbox" name="visualNovel" :value="old('visualNovel')" />
            </div>

            <div id="typeNobels">
                <input type="radio" id="manga" name="gender" value="manga">
                <label for="manga">Manga</label><br>
                <input type="radio" id="manhwa" name="gender" value="manhwa">
                <label for="manhwa">Manhwa</label><br>
                <input type="radio" id="manhua" name="gender" value="manhua">
                <label for="manhua">Manhua</label><br>
                <input type="radio" id="oneShot" name="gender" value="oneShot">
                <label for="oneShot">One shot</label><br>
                <input type="radio" id="other" name="gender" value="other">
                <label for="other">Other</label>        
                
                
                <div id="typeOthers">
                    <x-input id="typeOther" class="block mt-1 w-full" type="text" name="typeOther" :value="old('typeOther')" />
                </div>
            </div>


            <!-- Cover -->
            <div class="mt-4">
                <x-label for="cover" :value="__('Cover')" />

                <x-input id="cover" class="block mt-1 w-full" type="file" name="cover" :value="old('cover')" required />
            </div>

            <!-- Public -->
            <div class="mt-4">
                <x-label for="public" :value="__('Publico')" />

                <x-input id="public" class="block mt-1 w-full" type="checkbox" name="public" :value="old('public')" checked />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    Add
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

</body>
</html>

