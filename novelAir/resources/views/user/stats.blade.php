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
        <p class="text-lg text-white | pl-2">Tus subscriptores actuales</p>
    </div>
    <div class="flex | pl-5 mb-4">
        @foreach($subscriptionsThisWeek as $subscription)
            <div class="mx-2">
                <p class="text-white">{{$subscription->username}}</p>
            </div>
        @endforeach
    </div>
    <div class="flex justify-around | pl-5 mb-4">
        <div class="flex">
            <p class="text-white text-base">Historico:&nbsp</p> 
            <p class="text-green-600 font-bold text-base">{{count($subscriptions)}} subscriptores</p> 
        </div>
        <div class="flex">
        <p class="text-white text-base">Esta semana:&nbsp</p>
        <p class="text-green-600 font-bold text-base">{{count($subscriptionsThisWeek)}} subscriptores</p> 
        </div>
    </div>
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus donaciones</p>
    </div>
    <div class="flex flex-col | pl-5 mb-4">
        @foreach($donationsThisWeek as $donations)
            <div class="mx-2">
                <p class="text-white">{{$donations->username}}</p>
            </div>
        @endforeach
    </div>
    <div class="flex justify-around | pl-5 mb-4">
        <div class="flex">
        <p class="text-white text-base">Historico:&nbsp</p> 
        <p class="text-green-600 font-bold text-base">{{count($donations)}} donaciones</p> 
        </div>
        <div class="flex">
        <p class="text-white text-base">Esta semana:&nbsp</p>
        <p class="text-green-600 font-bold text-base">{{(count($donationsThisWeek))}} donaciones</p> 
        </div>
    </div>

</div>