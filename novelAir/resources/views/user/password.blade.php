<div class="w-10/12 | my-5 mx-auto">

    <form action="{{Route('changePass')}}" method="POST" >
        @csrf
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Cambio de contraseña</p>
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="newPassword">
                Nueva contraseña
            </label>

            <input class="shadow-lg border-none appearance-none 
            rounded w-full py-2 px-3 text-whtie leading-tight" 
            type="password" 
            name="newPassword" 
            value="">
        
        </div>
        <div class="pl-5 mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="newPasswordRepeat">
                Repite la contraseña
            </label>

            <input class="shadow-lg border-none appearance-none 
            rounded w-full py-2 px-3 text-whtie leading-tight" 
            type="password" 
            name="newPasswordRepeat" 
            value="">
        
        </div>
        <div class="flex items-center mb-4 ">

            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            type="submit"
            value="Cambiar">

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