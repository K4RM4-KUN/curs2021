<div class="w-10/12 | my-5 mx-auto">

    <form action="">

        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="presentation">
                Presentación
            </label>

            <textarea class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            name="presentation" placeholder="Hola que tal..."></textarea>
        </div>

        <div class="mb-4">
            
            <label class="block text-white text-sm font-bold mb-2" for="lista">
                Que lista quieres mostar en tu perfil?
            </label>

            <select name="lista" class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="order">
                @foreach ($lists as $list)
                    <option value="{{$list->id}}">{{ucfirst($list->state_name)}}</option>
                @endforeach
            </select>
        
        </div>
    </form>

</div>