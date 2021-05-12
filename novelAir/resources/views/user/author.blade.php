<div class="w-10/12 | my-5 mx-auto">

    <form method="POST"action="@if($role->role->rol_name == 'user'){{Route('verificationRequest')}}  @else{{Route('configAuthor')}} @endif">
        @csrf
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Formulario de verificación de autor</p>
        </div>
        <div class="pl-5 mb-4">
            @if($role->role->rol_name == 'admin' || $role->role->rol_name == 'author')
                <p class="text-white text-base">Ya estas verificado</p>
            @else
                <p class="text-white text-base">No estas verificado</p> 
                <div class="pl-0 mt-5 mb-2 | border-b-2 border-whtie">
                    <p class="text-lg text-white | pl-2">Formulario de verificación de autor</p>
                </div>
            @endif
        </div>
        @if($role->role->rol_name == 'admin' || $role->role->rol_name == 'author')
            <div class="pl-5 mb-4">
                
                <label class="block text-white text-sm font-bold mb-2" for="paypal">
                    Paypal donde recibir los pagos
                </label>

                <input class="shadow-lg border-none appearance-none 
                rounded w-full py-2 px-3 text-whtie leading-tight" 
                type="text" 
                name="paypal" 
                value="{{$author->paypal}}">
            
            </div>
        @endif
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Subscripciones de pago</p>
        </div>
        <div class="pl-5 mb-4">
            @if($role->role->rol_name == 'admin' || $role->role->rol_name == 'author')
            <div class="pl-5 mb-4">
                
                <p class="block text-white text-sm font-bold mb-2">
                    Desactivar subscripciones de pago
                </p>
                <div class="flex items-center justify-start">
                    <input class="shadow-lg border-none appearance-none 
                    rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                    type="checkbox" 
                    name="subscriptions" 
                    @if($author->subscriptions == 1) checked >
                    <label for="subscriptions" class="text-white">Desactivar</label>
                    @else
                    > 
                    <label for="subscriptions" class="text-white">Activar</label>
                    @endif
                </div>
            
            </div>
            @else
                <p class="text-white text-base">Debes estar verificado para utilizar esta función</p>
            @endif
        </div>
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Donaciones</p>
        </div>
        <div class="pl-5 mb-4">
            @if($role->role->rol_name == 'admin' || $role->role->rol_name == 'author')
            <div class="pl-5 mb-4">
                
                <p class="block text-white text-sm font-bold mb-2">
                    Desactivar donaciones
                </p>
                <div class="flex items-center justify-start">
                    <input class="shadow-lg border-none appearance-none 
                    rounded h-7 w-7 mx-3 px-3 text-whtie leading-tight" 
                    type="checkbox" 
                    name="donations" 
                    @if($author->donations == 1) checked >
                    <label for="donations" class="text-white">Desactivar</label>
                    @else
                    > 
                    <label for="donations" class="text-white">Activar</label>
                    @endif
                     
                </div>
            
            </div>
            @else
                <p class="text-white text-base">Debes estar verificado para utilizar esta función</p>
            @endif
        </div>
        <div class="flex items-center mb-4 ">

            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            type="submit"
            value="Guardar">

        </div>
    </form>

</div>