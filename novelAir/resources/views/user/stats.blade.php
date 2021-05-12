<div class="w-10/12 | my-5 mx-auto"> 
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus seguidores</p>
    </div>
    <div class=" flex | pl-5 mb-4">
        <p class="text-white text-base">Historico:&nbsp</p> 
        <p class="text-green-600 font-bold text-base">{{$follows}} seguidores</p> 
    </div>
    <div class="flex | pl-5 mb-4">
        <p class="text-white text-base">Esta semana:&nbsp</p>
        <p class="text-green-600 font-bold text-base">{{$follows}} seguidores</p> 
    </div>
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus subscripciones actuales</p>
    </div>
    <div class=" flex | pl-5 mb-4">
        <p class="text-white text-base">Historico:&nbsp</p> 
        <p class="text-green-600 font-bold text-base">{{count($subscriptions)}} subscriptores</p> 
    </div>
    <div class="flex | pl-5 mb-4">
        <p class="text-white text-base">Esta semana:&nbsp</p>
        <p class="text-green-600 font-bold text-base">{{count($subscriptions)}} subscriptores</p> 
    </div>
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus donaciones</p>
    </div>
    <div class=" flex | pl-5 mb-4">
        <p class="text-white text-base">Historico:&nbsp</p> 
        <p class="text-green-600 font-bold text-base">{{count($donations)}} donaciones</p> 
    </div>
    <div class="flex | pl-5 mb-4">
        <p class="text-white text-base">Esta semana:&nbsp</p>
        <p class="text-green-600 font-bold text-base">{{(count($donations))}} donaciones</p> 
    </div>

</div>