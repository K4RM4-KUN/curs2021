<div class="w-10/12 | my-5 mx-auto"> 
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Tus subscripciones actuales</p>
    </div>
    <div class="    ">
        @foreach($subscriptions as $sub)
        <div class="flex items-center justify-start | border-b-2 border-white">
            <div class="border-r-2 border-white | px-5">
                <p class="text-white text-lg">{{$loop->index+1}}</p>
            </div>
            <div class="border-r-2 border-white | px-5">
                <p class="text-white text-lg">{{Auth::user()->name}} {{Auth::user()->surname}}</p>
            </div>
            <div class="border-r-2  | px-5">
                <p class="text-white text-lg">{{$sub->username}}</p>
            </div>
            <div class="border-r-2 border-white | px-5">
                <p class="text-white text-lg">{{$sub->subscription_price}} €</p>
            </div>
            <div class="border-white | px-5">
                <p class="text-white text-lg">{{$sub->created_at}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-5 mb-2 | border-b-2 border-whtie">
        <p class="text-lg text-white | pl-2">Historial de pagos</p>
    </div>

</div>