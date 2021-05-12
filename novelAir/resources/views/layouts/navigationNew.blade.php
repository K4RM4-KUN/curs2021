<!-- navbar -->
<nav x-data="{ open: false }" class="sm:sticky top-0 | bg-white border-b-4 border-ourBlue ">

    <div class="max-w-7xl mx-auto h-1/1">

        <div class="flex justify-between">

            <div class="flex">

                <!-- logo -->
                <div class="mx-5 flex items-center justify-center w-40">

                    <a class="" href="{{url('/')}}">

                        <img class="h-20 w-40" src="{{asset('images/logo2.png')}}" alt="logo">

                    </a>

                </div>
                
                <!-- primary -->
                <div class="hidden md:flex items-center mx-5">

                    <!-- BIBLIOTECA -->
                    <div x-data="{ dropdownOpen: false }">

                        <button @click="dropdownOpen = !dropdownOpen" class="px-5 py-7 hover:bg-ourBlue hover:text-white font-bold text-ourBlue">

                            BIBLIOTECA

                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="dropdownOpen" class="absolute mt-2 bg-white rounded-md overflow-hidden shadow-xl z-20">
                            <a href="{{url('biblioteca/novelas')}}" class="block px-4 py-2 text-sm hover:bg-ourBlue hover:text-white font-bold text-ourBlue"><p class="text-center">Novelas</p></a>
                            <a href="{{url('biblioteca/visual_novels')}}" class="block px-4 py-2 text-sm hover:bg-ourBlue hover:text-white font-bold text-ourBlue"><p class="text-center">Visual Novels</p></a>
                        </div>
                    </div>

                    <!-- LISTA -->
                    <a href="{{url('listas')}}">

                        <button class="px-5 py-7 hover:bg-ourBlue hover:text-white font-bold text-ourBlue">

                            LISTAS

                        </button>
                        
                    </a>

                    <!-- AUTORES -->
                    <a href="{{Route('authors')}}">

                        <button class="px-5 py-7 hover:bg-ourBlue hover:text-white font-bold text-ourBlue">

                            AUTORES

                        </button>

                    </a>

                    <!-- CREAR  bg-gray-100-->
                    <a href="{{Route('goNM')}}">

                        <button class="px-5 py-7 hover:bg-ourBlue hover:text-white text-black font-bold text-ourBlue">

                            CREAR

                        </button>
                        
                    </a>

                    <!-- NOSOTROS -->
                    <a href="@{{Route('aboutUs')}}">

                        <button class="px-5 py-7 hover:bg-ourBlue hover:text-white font-bold text-ourBlue">

                            NOSOTROS

                        </button>
                        
                    </a>

                </div>

            </div>

            <!-- secondary/auth -->
            <div class="hidden md:flex items-center justify-center">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log out') }}
                        </x-responsive-nav-link>
                    </form>

                    <a href="">

                        <button class="mx-5 mr-2 px-5 py-2">

                            LOGIN

                        </button>

                    </a>

                    <a href="">

                        <button class="mx-5 ml-0 px-5 py-2
                        bg-yellow-500 
                        hover:bg-yellow-400 
                        text-white 
                        font-bold 
                        border-b-4 
                        border-yellow-700 
                        hover:border-yellow-500 
                        rounded">

                            REGISTER

                        </button>

                    </a>

            </div>
        </div>

    </div>

    <!-- mobile -->
    


</nav>