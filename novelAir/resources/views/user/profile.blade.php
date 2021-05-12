<div class="w-10/12 | my-5 mx-auto">

    <form action="{{Route('updateProfile')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Perfil privado</p>
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="private">
                Haz tu perfil privado
            </label>
            <div class="flex items-center justify-start">
                <input class="shadow-lg border-none appearance-none 
                rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                type="checkbox" 
                name="private" 
                @if($profile->private == 1) checked @endif
                >
                <p class="text-white">Privado</p>
            </div>
        
        </div>
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Personalización</p>
        </div>
        <div class="pl-5 mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="profileImage">
                Fondo de perfil(Fotos de 9:16):
            </label>
            <div class="flex items-center justify-around">
                <img class="rounded-full" width="10% " src="{{asset($image)}}" alt="">
                <input class="border-none appearance-none rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline" 
                name="bgImage" 
                type="file"
                accept="image/jpg,image/jpeg,image/png">
            </div>
        </div>

        <div class="pl-5 mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="presentation">
                Presentación
            </label>

            <textarea class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            name="presentation" 
            placeholder="Hola que tal..."
            >{{$profile->presentation}}</textarea>
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="lista">
                Que lista quieres mostar en tu perfil?
            </label>

            <select 
            name="lista"
            class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="order">
                <option @if($profile->state_id == 0) selected @endif value="0">Ninguno</option>
                @foreach ($lists as $list)
                    <option @if($profile->state_id == $list->id) selected  @endif value="{{$list->id}}">{{ucfirst($list->state_name)}}</option>
                @endforeach
            </select>
        
        </div>
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Redes sociales</p>
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="face">
                Facebook
            </label>
            <div class="flex items-center justify-start">
                <input class="shadow-lg border-none appearance-none 
                rounded w-3/6 py-2 px-3 text-whtie leading-tight" 
                type="text" 
                name="face" 
                value="{{$profile->facebook}}">
                <input class="shadow-lg border-none appearance-none 
                rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                type="checkbox" 
                id="facebook"
                name="showFace" 
                @if($profile->showFace == 1) checked @endif>
                <label for="facebook" class="text-white">Mostrar</label>
            </div>
        
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="twitter">
                Twitter
            </label>
            <div class="flex items-center justify-start">
                <input class="shadow-lg border-none appearance-none 
                rounded w-3/6 py-2 px-3 text-whtie leading-tight" 
                type="text" 
                name="twitter" 
                value="{{$profile->twitter}}">
                <input class="shadow-lg border-none appearance-none 
                rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                type="checkbox" 
                id="twitter"
                name="showTwitter" 
                @if($profile->showTwitter == 1) checked @endif>
                <label for="twitter" class="text-white">Mostrar</label>
            </div>
        
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="patreon">
                Patreon
            </label>
            <div class="flex items-center justify-start">
                <input class="shadow-lg border-none appearance-none 
                rounded w-3/6 py-2 px-3 text-whtie leading-tight" 
                type="text" 
                name="patreon" 
                value="{{$profile->patreon}}">
                <input class="shadow-lg border-none appearance-none 
                rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                type="checkbox" 
                id="patreon"
                name="showPatreon" 
                @if($profile->showPatreon == 1) checked @endif>
                <label for="patreon" class="text-white">Mostrar</label>
            </div>
        
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="instagram">
                Instagram
            </label>
            <div class="flex items-center justify-start">
                <input class="shadow-lg border-none appearance-none 
                rounded w-3/6 py-2 px-3 text-whtie leading-tight" 
                type="text" 
                name="instagram" 
                value="{{$profile->instagram}}">
                <input class="shadow-lg border-none appearance-none 
                rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                type="checkbox" 
                id="instagram"
                name="showInstagram" 
                @if($profile->showInstagram == 1) checked @endif>
                <label for="instagram" class="text-white">Mostrar</label>
            </div>
        
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="other">
                Other
            </label>
            <div class="flex items-center justify-start">
                <input class="shadow-lg border-none appearance-none 
                rounded w-3/6 py-2 px-3 text-whtie leading-tight" 
                type="text" 
                name="other" 
                value="{{$profile->other}}">
                <input class="shadow-lg border-none appearance-none 
                rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                type="checkbox" 
                name="showOther"
                id="other"
                @if($profile->showOther == 1) checked @endif>
                <label for="other" class="text-white">Mostrar</label>
            </div>
            
        </div>
        <div class="flex items-center justify-start">

            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            type="submit"
            value="Guardar">

        </div>
    </form>
    @if ($errors->any())
        <div class="pl-5 mb-4 flex align-center justify-center">
            <table>
            @foreach ($errors->all() as $error)
                <tr><td><a class="text-white">{{ $error }}</a></td></tr>
            @endforeach
            </table>
        </div>
    @endif

</div>