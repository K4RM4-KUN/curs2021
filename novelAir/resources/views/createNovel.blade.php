<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <a href="{{ url()->previous() }}">BACK</a>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('insertNovel') }}">
            @csrf
            
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Genre -->
            <div>
                <x-label for="genre" :value="__('Genero')" />

                <x-input id="genre" class="block mt-1 w-full" type="text" name="genre" :value="old('genre')" required autofocus />
            </div>

            <!-- Sinopsis -->
            <div class="mt-4">
                <x-label for="sinopsis" :value="__('Sinopsis')" />

                <x-input id="sinopsis" class="block mt-1 w-full" type="text" name="sinopsis" :value="old('sinopsis')" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    Add
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
