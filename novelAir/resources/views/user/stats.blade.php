<div class="w-10/12 | my-5 mx-auto"> 
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus seguidores</p>
    </div>
    <div class="flex justify-around | pl-1 sm:pl-5 mb-4">
        <div class="flex flex-col sm:flex-row | pl-1 sm:pl-5 mb-4">
            <p class="text-center sm:text-left text-white text-base">Este més:&nbsp</p>
            <p class="text-center sm:text-left text-green-600 font-bold text-sm sm:text-base">{{$followsThisMonth}} seguidores</p> 
        </div>
        <div class="flex flex-col sm:flex-row | pl-1 sm:pl-5 mb-4">
            <p class="text-center sm:text-left text-white text-base">Historico:&nbsp</p> 
            <p class="text-center sm:text-left text-green-600 font-bold text-sm sm:text-base">{{$follows}} seguidores</p> 
        </div>
    </div> 
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus subscriptores actuales</p>
    </div>
    @if($role->role_id != 1) 
        <div class="flex | pl-5 mb-4">
            @foreach($activeSubscribers as $subscription)
                <div class="mx-2">
                    <p class="text-white">{{$subscription->username}}</p>
                </div>
            @endforeach
        </div>
        <div class="flex justify-around | pl-1 sm:pl-5 mb-4">
            <div class="flex flex-col sm:flex-row">
                <p class="text-white text-base">Activos:&nbsp</p>
                <p class="text-center sm:text-left text-green-600 font-bold text-sm sm:text-base">{{count($activeSubscribers)}} subs</p> 
            </div>
            <div class="flex flex-col sm:flex-row">
                <p class="text-white text-base">Historico:&nbsp</p> 
                <p class="text-center sm:text-left text-green-600 font-bold text-sm sm:text-base">{{count($subscriptions)}} subs</p> 
            </div>
        </div> 
    @else
        <div class="flex justify-around | pl-1 sm:pl-5 mb-4">
            <div class="flex sm:flex-row">
                <p class="text-white  text-sm sm:text-base">Debes estar verificado para utilizar esta función</p>
            </div>
        </div> 
    @endif

</div>