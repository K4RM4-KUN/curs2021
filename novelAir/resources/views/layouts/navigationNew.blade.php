<!-- navbar -->
<nav x-data="{ open: false }" class="afixed | w-full | bg-white border-b-4 border-ourBlue ">
 
        <div class="flex flex-col md:flex-row w-full ">

            <div class="flex w-full md:w-2/12 justify-center items-center">
                <!--LOGO-->
                <div class="w-1/1 md:w-1/1 flex justify-center"> 
                    <a class="" href="{{url('/')}}">
                        <img class="h-20 w-1/1" src="{{asset('images/logo2.png')}}" alt="logo">
                    </a> 
                </div> 
                <div class="display-button | flex md:hidden items-center justify-center | w-1/2 |">
                    <p class="text-ourBlue font-bold text-base | py-2 pl-5">Menu</p>
                    <p class="display-status text-ourBlue font-bold text-sm sm:text-base | py-2 px-2 sm:px-5">\/</p>
                </div>
            </div>
            <!-- primary -->
            <div class="primary | hidden md:flex md:w-10/12">
                <!--nav buttons-->
                <div class="w-1/1 md:w-8/12 | flex items-center justify-center flex-col sm:flex-row md:flex-row | border-b-2 border-ourBlue mx-20 sm:mx-16 md:mx-0 md:border-0"> 
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

                    <!-- CREAR 
                    <a href="{{Route('goNM')}}"> 
                        <button class="px-5 py-7 hover:bg-ourBlue hover:text-white text-black font-bold text-ourBlue"> 
                            CREAR 
                        </button> 
                    </a>-->

                    <!-- NOSOTROS -->
                    <a href="{{Route('aboutUs')}}"> 
                        <button class="px-5 py-7 hover:bg-ourBlue hover:text-white font-bold text-ourBlue"> 
                            NOSOTROS 
                        </button> 
                    </a> 
                </div>
                <div class="w-1/1 md:w-4/12 | flex items-center justify-center flex-col sm:flex-row md:flex-row | mx-auto"> 
                    @if(Auth::check())
                        <!--LOGGED-->
                        <div class="flex justify-center items-center w-full">
                            <div class="flex justify-center | w-1/1">
                                <a href="{{url('perfil/'.Auth::user()->id.'/'.Auth::user()->username.'personal')}}">
                                    <img class="w-20" 
                                    src="{{asset('users/'.Auth::user()->id.'/profile/usericon'.Auth::user()->imgtype)}}" 
                                    alt="">
                                </a>
                            </div>
                            <div class="flex flex-row md:flex-col md:ml-2 | w-3/3">
                                <div class="flex justify-center h-1/3">
                                    <a href="{{url('perfil/'.Auth::user()->id.'/'.Auth::user()->username.'personal')}}">
                                        <p class="px-3 font-bold text-ourBlue hover:bg-ourBlue hover:text-white text-lg">{{Auth::user()->username}}</p>
                                    </a>
                                </div>
                                <div class="hidden sm:flex justify-center h-1/3">
                                    <a href="{{route('goNM')}}">
                                        <p class="px-3 font-bold text-ourBlue hover:bg-ourBlue hover:text-white text-base">Crear</p>
                                    </a>
                                    <a href="{{url('usuario/ajustes')}}">
                                        <p class="px-3 font-bold text-green-500 hover:bg-green-500 hover:text-white text-base">Ajustes</p>
                                    </a>
                                </div>
                                <div class="flex justify-center h-1/3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="px-3 font-bold text-red-500 hover:bg-red-500 hover:text-white text-base" type="submit">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!--NOT LOGGED-->
                        <div class="flex justify-center items-center w-full py-3 md:py-0"> 
                            <div class="flex justify-center h-1/2 mr-5">
                                <a href="{{ route('login') }}" class="text-sm sm:text-lg text-ourBlue">Log in</a>
                            </div>
                            <div class="flex justify-center h-1/2">
                                <a href="{{ route('register') }}" 
                                class="mx-5 ml-0 px-5 py-2
                                bg-yellow-500 
                                hover:bg-yellow-400 
                                text-white 
                                font-bold 
                                border-b-4 
                                border-yellow-700 
                                hover:border-yellow-500 
                                rounded">Register</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
                
        </div>
 

    <script>
        $(document).ready(()=>{
            $('.display-button').click(function(){
                if($('.display-status').text() == '\\/'){
                    $('.display-status').text('/\\');
                } else {
                    $('.display-status').text('\\/');
                }
                $('.primary').toggle('hidden')
                $('.secondary').toggle('hidden')
            })
        })
    </script>

</nav>