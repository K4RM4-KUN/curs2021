<div class="w-10/12 | my-5 mx-auto"> 
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus subscripciones actuales</p>
    </div>
    <div class="w-full">
        <table class="w-full">
            <tr class="border-b-2">
                <th class="border-r-2 border-l-2">
                    <p class="text-white text-left text-sm sm:text-base | pl-2">Author</p>
                </th>
                <th class="border-r-2 border-l-2">
                    <p class="text-white text-left text-sm sm:text-base | pl-2">Costo</p>
                </th>
                <th class="border-r-2 border-l-2">
                    <p class="text-white text-left text-sm sm:text-base | pl-2">Activa hasta</p>
                </th>
            </tr>
            @foreach($subscriptions as $sub) 
                <tr class="border-b-2">
                    <td class="border-r-2 border-l-2">
                        <p class="text-white text-sm sm:text-base | pl-2 ">{{$sub->username}}</p>
                    </td>
                    <td class="border-r-2 border-l-2">
                        <p class="text-white text-sm sm:text-base | pl-2">{{$sub->subscription_price}} €</p>
                    </td>
                    <td class="border-r-2 border-l-2">
                        <p class="text-white text-xs sm:text-base | pl-2">{{$sub->caducate_at}}</p>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Historial de pagos</p>
    </div>
    <div class="w-full">
        <table class="w-full table-auto">
            <tr class="border-b-2">
                <th class="border-r-2 border-l-2">
                    <p class="text-white text-left text-sm lg:text-base | pl-2">ID de pago</p>
                </th>
                <th class="hidden lg:table-cell  border-r-2 border-l-2">
                    <p class="text-white text-left text-sm lg:text-base | pl-2">ID de comprador</p>
                </th>
                <th class="hidden sm:table-cell  border-r-2 border-l-2">
                    <p class="text-white text-left text-sm lg:text-base | pl-2">Cantidad</p>
                </th>
                <th class="hidden sm:table-cell border-r-2 border-l-2">
                    <p class="text-white text-left text-sm lg:text-base | pl-2">Fecha del pago</p>
                </th>
            </tr>
        @foreach($payments as $pay)
                <tr class="border-b-2">
                    <td class="border-r-2 border-l-2">
                        <p class="text-white text-xs | pl-2">{{$pay->payment_id}}</p>
                    </td> 
                    <td class="hidden lg:table-cell border-r-2 border-l-2">
                        <p class="text-white text-sm | pl-2">{{$pay->payer_id}}</p>
                    </td>
                    <td class="hidden sm:table-cell   border-r-2 border-l-2">
                        <p class="text-white text-sm sm:text-base | pl-2">{{$pay->amount}} €</p>
                    </td>
                    <td class="hidden sm:table-cell  border-r-2 border-l-2">
                        <p class="text-white text-xs sm:text-sm | pl-2">{{$pay->created_at}}</p>
                    </td>
                </tr>
            @endforeach
        </table>
        <p class="py-2 block lg:hidden text-white text-xs sm:text-sm">Importante: Para ver correctamente todos los datos de los pagos es mejor utilizar un ordenador...</p>
    </div>

</div>