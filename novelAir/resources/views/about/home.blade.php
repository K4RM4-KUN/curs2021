<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nosostros</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
        body{
            user-select:none;
        }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    </head>
    <body class="bg-gradient-to-br from-gray-700 to-gray-800 min-h-screen"> 
            <!--@@include('layouts.navigationNew')-->
            @include('layouts.navigationNew')
        <div class="flex flex-col justify-center items-center | w-full">
            <!--AboutUs Nav-->
            <div class="border-b-2 border-gray-600 | bg-white | font-bold text-center text-xs lg:text-sm xl:text-base text-gray-400 | space-x-0 sm:space-x-4 flex flex-col sm:flex-row justify-center items-center | w-full"> 
                <a 
                href="{{url('nosotros/info')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 | @if($type == 'info')bg-gray-100 text-gray-600 @else bg-white hover:bg-gray-100 hover:text-gray-600 @endif ">
                    <p>GENERAL</p>
                </a> 
                <a 
                href="{{url('nosotros/contactanos')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 | @if($type == 'contactanos')bg-gray-100 text-gray-600 @else bg-white hover:bg-gray-100 hover:text-gray-600 @endif ">
                    <p>CONTACTANOS</p>
                </a>  
                <a 
                href="{{url('terminos')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 |  bg-white hover:bg-gray-100 hover:text-gray-600">
                    <p>TÉRMINOS Y POLÍTICAS</p>
                </a>  
            </div>
            <!--AboutUs Content-->
            <div class="text-justify w-full sm:w-10/12 bg-white bg-opacity-70 shadow-xl">
                <!--AboutUs General-->
                <div class="@if($type != 'info') hidden @endif w-full | px-10 pt-3 pb-10 | text-sm">
                    <p class="text-ourBlue text-2xl font-bold text-left p-2">Información general</p>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Qué es NovelAir?</h2> 
                    <p class="text-base px-4 py-2 text-justify">NovelAir es la web que como lector quedras utilizar para leer tus novelas 
                    y comics favoritos y como autor la página que te permitira compartir y monetizar tu contenido a partir de las subscripciones,
                    las cuales tendran un costo de 2,50€</p> 
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Por qué utilizarnos?</h2> 
                    <p class="text-base px-4 py-2 text-justify">Como amantes de la lectura hemos creado esta web
                    para que gente como tu, no, como nosotros se sienta comoda mientras lee o descubre nuevas obras!</p> 
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Como monetizar mis obras?</h2> 
                    <p class="text-base px-4 py-2 text-justify">Para monetizar tus obras deberas solicitar la verificación de
                    tu cuenta desde los ajustes de usuarios en "Author" donde podras rellenar un formulario con algunos
                    de tus datos, si todos son correctos podras convertirte en un "Author verificado" y podras habilitar
                    la opcion de subscripcion de pago!</p> 
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Quienes somos?</h2> 
                    <p class="text-base px-4 py-2 text-justify">Pues como tu, que estas leyendo este parráfo, somos amantes empedernidos
                    de la lectura, tanto de novelas ligeras como comics de todos los estilos y paises, y mira por donde que también
                    somos programadores web, asi que a la hora de hacer uno de los projectos durante nuestros estudios decidimos crear 
                    esta web, y esperamos que la disfrutéis! </p> 
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">ADMINISTRADORES</h2> 
                    <div class="font-bold text-white text-lg | flex justify-left w-full px-4 py-2"> 
                            <a  class="bg-ourBlue border-2 border-blue-400 hover:bg-white hover:text-ourBlue | mx-2 px-2" href="{{url('perfil/2/Drax121')}}">
                                <p>Drax121</p>
                            </a> 
                            <a class="bg-ourBlue border-2 border-blue-400 hover:bg-white hover:text-ourBlue | mx-2 px-2" href="{{url('perfil/1/K4RM4')}}">
                                <p>K4RM4</p>
                            </a> 
                    </div>
                </div>
                <!--AboutUs Contacto-->
                <div class="@if($type != 'contactanos') hidden @endif w-full px-10 pt-3 pb-10 | text-sm">
                    <p class="text-ourBlue text-2xl font-bold text-left p-2">Contactanos!</p>
                    <p class="text-base px-4 py-2 text-left">Puedes utilizar este formulario para contactar cno nosotros para resolver
                    alguna duda o problema con nuestro servicio o contenido, también puedes reportarnos sobre algun usuario que haya
                    hecho algo inadecuado o roto alguna regla de la comunidad...</p>
                    <!-- Formulario -->
                    @if(isset(Auth::user()->email))
                        <p class="text-ourBlue text-center text-xl font-bold mt-5 p-2">Envianos un mail:</p>
                        <form action="{{route('contact')}}" method="post" class="w-full lg:w-1/2 mx-auto text-black">
                            @csrf
                            <!-- Email Address -->
                            <div class="my-4">
                                <label for="email" class="text-2xl">Email</label>
                                <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="email" type="email" name="email" value="{{Auth::user()->email}}" required />
                            </div>
                            <div class="my-4">
                                <label for="subject" class="text-2xl">Asunto</label>
                                <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="subject" type="text" name="subject" value="" placeholder="Ayuda..." required />
                            </div>

                            <!-- Text Area -->
                            <div class="my-4">
                                <label for="email" class="text-2xl">Mensaje</label>
                                <textarea class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="email" name="message" required></textarea>
                            </div>

                            @if($sended == 'yes')
                                <p class="text-green-500 text-center text-LG font-bold mt-5 p-2">Mail Enviado</p>
                            @endif
                            
                            <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                            type="submit"
                            value="Enviar">
                        </form>
                    @else
                        <p class="text-ourBlue text-2xl font-bold text-left p-2 text-center">Registrate para ponerte en contacto</p>
                    @endif
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </body>
</html>
