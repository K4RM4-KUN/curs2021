<div class="w-10/12 | my-5 mx-auto">

    <form method="POST" enctype="multipart/form-data" action="@if($role->role->rol_name == 'user'){{Route('verificationRequest')}}  @else{{Route('configAuthor')}} @endif">
        @csrf
        <div class="mt-5 mb-2 | border-b-2 border-whtie">
            <p class="text-lg text-white | pl-2">Formulario de verificación de autor</p>
        </div>
        <div class="pl-5 mb-4">
            @if($role->role->rol_name == 'admin' || $role->role->rol_name == 'author')
                <p class="text-white text-base">Ya estas verificado</p>
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
        @else
            @if($request_state == 'pendiente')
                <div class="pl-5 mb-4"> 
                        <p class="text-yellow-300 text-base">Tu ultima solicitud esta pendiente de resolución...</p> 
                </div>
            
            @elseif($request_state == 'aceptada')
                <div class="pl-5 mb-4"> 
                        <p class="text-green-500 text-base">Tu solicitud ha sido aceptada, en poco tiempo tu cuenta sera verificada.</p> 
                </div>
            @else
                @if($request_state == 'denegada')
                    <div class="pl-5 mb-4"> 
                            <p class="text-red-500 text-base">Tu ultima solicitud a sido denegada.</p> 
                    </div>
                @endif
                <div class="pl-5 mb-4">
                    <label class="block text-white text-sm font-bold mb-2" for="names">
                        Nombre y apellidos
                    </label> 
                    <input class="shadow-lg border-none appearance-none 
                    rounded w-full py-2 px-3 text-whtie leading-tight" 
                    type="text" 
                    name="names" 
                    value="{{ucfirst(Auth::user()->name)}} {{ucfirst(Auth::user()->surname)}}">
                </div>
                <div class="pl-5 mb-4 ">
                    <label class="block text-white text-sm font-bold mb-2" for="birth_date">
                        Fecha de nacimiento
                    </label> 
                    <input class="shadow-lg border-none appearance-none 
                    rounded w-full py-2 px-3 text-whtie leading-tight" 
                    type="date" 
                    name="birth_date" 
                    value="{{Auth::user()->birth_date}}">
                </div>
                <div class="pl-5 mb-4"> 
                    <label class="block text-white text-sm font-bold mb-2" for="idPhoto">
                        Selfie tuya mostrando tu DNI/NIE o documento Identificativo:
                    </label>
                    <div class="flex items-center justify-around">
                        <input class="border-none appearance-none rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline" 
                        name="idPhoto" 
                        type="file"
                        accept="image/jpg,image/jpeg,image/png">
                    </div>
                </div>
                <div class="pl-5 mb-4">
                    <label class="block text-white text-sm font-bold mb-2" for="numId">
                        Numero de DNI/NIE o documento Identificativo:
                    </label> 
                    <input class="shadow-lg border-none appearance-none 
                    rounded w-full py-2 px-3 text-whtie leading-tight" 
                    type="text" 
                    name="numId"
                    placeholder="39423223K">
                </div>
                <div class="pl-5 mb-4"> 
                    <label class="block text-white text-sm font-bold mb-2" for="content">
                        Documentos de propiedad intelectual:
                    </label>
                    <div class="flex items-center justify-around">
                        <input class="border-none appearance-none rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline" 
                        name="content[]"
                        multiple
                        id="content"
                        type="file"
                        >
                    </div>
                </div>
                <div class="pl-5 mb-4 ">
                    <p class="text-white text-sm">Esta solicitud sera enviada a un moderador de la página, 
                    este revisara cada una de tus novelas para comprobar que no infringen ningúna norma, si alguna de tus novelas
                    la infringiera recibirias información sobre el motivo y cual de tus novelas infringe la norma. Si dispones de 
                    la propiedad intelectual de alguna de tus novelas puedes adjuntar un documento que lo demuestre en 
                    el formulario, si quieres más información sobre que normas tenemos puedes ir a "Ayuda" > "Términos de Uso".</p>
                </div>
                <div class="pl-5 mb-4"> 

                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                    type="submit"
                    value="Enviar">

                </div>
            @endif
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
                <p class="text-white text-sm sm:text-base">Debes estar verificado para utilizar esta función</p>
            @endif
        </div>

        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
        type="submit"
        value="Guardar">

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