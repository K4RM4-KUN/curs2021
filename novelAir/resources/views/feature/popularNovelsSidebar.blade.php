<div class="w-32 min-w-screen | fixed | bg-gray-900">
        <div class="w-1/1">
            <p class="mb-2.5 | text-center text-xl text-white font-bold">
                TOP 10 DE LA SEMANA
            </p>
            <p class="text-center text-xl text-white font-bold mb-5 border-b-2">
                @if($featureds[0]->visual_novel == 1)
                    Visual novels
                @else
                    Novelas
                @endif
            </p>
        </div>
        @foreach($featureds as $featured)
        <div class="w-1/1">
            <div class="flex items-end">
                <p class="p-2.5 mr-1 | text-center text-4xl |
                @if($loop->index == 0)text-gold border-gold 
                @elseif($loop->index == 1)text-silver border-silver 
                @elseif($loop->index == 2)text-bronze border-bronze 
                @else text-white 
                @endif 
                font-bold | border-b-2">
                    {{$loop->index+1}}.
                </p>
                <a href="{{url('novel/'.$featured->id)}}">
                    <div class="">
                        <p class="p-2.5 | text-left text-xl text-white font-bold | border-b-2">
                            {{$featured->name}}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </table>
</div>