<div class="w-10/12 | my-5 mx-auto">

    <form action="{{Route('updateUser')}}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="username">
                Username
            </label>

            <input class="shadow-lg border-none appearance-none 
            rounded w-full py-2 px-3 text-whtie leading-tight" 
            type="text" 
            name="username" 
            value="{{Auth::user()->username}}">
        
        </div>
        <div class="mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="surname">
                E-mail
            </label>

            <input class="shadow-lg border-none appearance-none 
            rounded w-full py-2 px-3 text-whtie leading-tight" 
            type="email" 
            name="surname" 
            value="{{Auth::user()->email}}">
        
        </div>
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="profileImage">
                Foto de perfil(Fotos de 1:1):
            </label>
            <div class="flex items-center justify-around">
                <img class="rounded-full" width="10% " src="{{asset($image)}}" alt="">
                <input class="border-none appearance-none rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline" 
                name="profileImage" 
                type="file"
                accept="image/jpg,image/jpeg,image/png">
            </div>
        </div>
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Información personal</p>
        </div>
        <div class="mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="name">
                Nombre
            </label>

            <input class="shadow-lg border-none appearance-none 
            rounded w-full py-2 px-3 text-whtie leading-tight" 
            type="text" 
            name="name" 
            value="{{Auth::user()->name}}">
        
        </div>
        <div class="mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="surname">
                Apellidos
            </label>

            <input class="shadow-lg border-none appearance-none 
            rounded w-full py-2 px-3 text-whtie leading-tight" 
            type="text" 
            name="surname" 
            value="{{Auth::user()->surname}}">
        
        </div>
        <div class="mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="birth_date">
                Fecha de nacimiento
            </label>

            <input class="shadow-lg border-none appearance-none 
            rounded w-full py-2 px-3 text-whtie leading-tight" 
            type="date" 
            name="birth_date" 
            value="{{Auth::user()->birth_date}}">
        
        </div>
        <div class="flex items-center justify-start">

            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            type="submit"
            value="Acceptar">

        </div>
    </form>

    @if ($errors->any())
        <div class="mb-4 flex align-center justify-center">
            <table>
            @foreach ($errors->all() as $error)
                <tr><td><a class="text-whtie">{{ $error }}</a></td></tr>
            @endforeach
            </table>
        </div>
    @endif
</div>