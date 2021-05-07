<div class="fixed | w-1/1 | mx-2 | bg-gray-900">

    <div class="px-14">

        <p class="text-white text-lg text-center font-bold | p-5 pb-0">
            @if($featureds[0]->visual_novel == 1)
                Visual novels
            @else
                Novelas
            @endif
        </p>

        <p class="text-white text-lg text-center font-bold |p-5 pt-0 pb-2 | border-b-2">TOP 10 DE LA SEMANA</p>
        
    </div>

    <div class="px-14 | mb-5">

        @foreach($featureds as $featured)
            <a class="flex items-end | w-1/1 | border-b-2
            @if($loop->index == 0)text-gold border-gold 
            @elseif($loop->index == 1)text-silver border-silver 
            @elseif($loop->index == 2)text-bronze border-bronze 
            @else text-white @endif" href="{{url('novel/'.$featured->id)}}">

                <div>

                    <p class="p-2.5 mr-1 | text-center text-4xl | font-bold">
                        {{$loop->index+1}}.
                    </p>

                </div>

                <div>
                
                    <p class="p-2.5 | text-left text-xl text-white font-bold | truncate">
                        {{$featured->name}}
                    </p>

                </div>

            </a>
        @endforeach

    </div>

</div>