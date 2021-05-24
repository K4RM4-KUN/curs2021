<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin User Manager</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://kit.fontawesome.com/f01c1fd989.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    </head>
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">

        @include('layouts.navigationNew')

        
        
        <div class="flex flex-col justify-items-center | w-full">

            <!-- Back -->
            <div class="w-full sm:w-10/12 mx-auto my-3">
                <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('goAdmin')}}">BACK</a>
            </div>

            <div class="flex flex-wrap justify-center | w-full">
            
                <!-- Usuario -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Usuario</p>
                    </div>
                    <div class="mx-1 sm:mx-7">
                        <div class="my-7">
                            <div class="flex flex-col mx-1 sm:mx-10 my-5">
                                <!-- Imagen -->
                                <div class="mx:3 sm:mx-5 xl:mx-24">
                                    <img class="mx-auto | rounded-full" width="50%" 
                                    @if(file_exists(public_path() ."/users/". $user->id ."/profile/usericon". $user->imgtype))
                                        src="{{asset("/users/". $user->id ."/profile/usericon". $user->imgtype)}}"
                                    @else
                                        src="{{asset("/images/noimage.png")}}"
                                    @endif
                                    alt="">
                                </div>

                                <!-- Perfil -->
                                <div class="my-8">
                                    <p class="font-bold text-3xl">{{$user->username}}</p>
                                    <p><b>Presentacion:</b> {{$profile->presentation}}</p>
                                </div>

                                <!-- Fotmulario y bloquear/eliminar -->
                                <div class="flex flex-wrap ">
                                    <!-- Formulario -->
                                    <div class="flex flex-col | w-full lg:w-1/2">
                                        <form action="{{route('adminEditUser')}}" method="post">
                                            @csrf
                                            <input type="text" name="idUser" value="{{$user->id}}" hidden>
                                            <!-- Rol -->
                                            <div>
                                                <p><b>Rol:</b> 
                                                    <select name="roles">
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}" @if($role->id == $rolUserSearch->role->id) selected @endif >{{strtoupper($role->rol_name)}}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>

                                            <!-- Submit -->
                                            <div class="my-5">
                                                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                                type="submit"
                                                value="Aceptar">
                                            </div>
                                        </form>
                                    </div>

                                    <div class="flex flex-wrap| w-full lg:w-1/2 | justify-around">
                                        <div>
                                            <a class="my-2 | py-2 px-4 | bg-yellow-400 hover:bg-yellow-500 | text-white font-bold | rounded | focus:outline-none focus:shadow-outline" 
                                                href="{{url('admin/blockUser/'.$user->id)}}">Bloquear</a>
                                        </div>
                                        <div>
                                            <a class="my-2 | py-2 px-4 | bg-red-600 hover:bg-red-700 | text-white font-bold | rounded | focus:outline-none focus:shadow-outline" 
                                                href="{{url('admin/removeUser/'.$user->id)}}">Eliminar</a>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Novelas -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Sus novelas</p>
                    </div>
                    <div class="mx-7">
                        <!-- Formulario -->
                        <div class="border-b-2">
                            <p class="text-base text-black mb-3">Buscar</p>
                            <form action="{{route('adminSearch')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div>
                                    <select class="mi-selector shadow-lg border-none appearance-none rounded w-3/6 py-2 px-3 text-white leading-tight"
                                    name="novel">
                                        @foreach($novels as $novel)
                                            <option value='{{$novel->id}}'>{{$novel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-5">
                                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                    type="submit"
                                    value="Buscar">
                                </div>
                            </form>
                        </div>

                        <!-- Lista Novelas -->
                        <div class="my-7">
                            <p class="text-base text-black mb-3">Novelas</p>
                            <div class="flex flex-wrap">
                            @foreach($novels as $result)
                                <div class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12">
                                    <div class="m-2">
                                        <a href="{{url('admin/novel/'.$result->id)}}">   
                                            <div class="bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                                                <div class="w-full | h-32 | flex flex-wrap content-end">
                                                    <div class="w-full">
                                                        <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contacto -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Enviar Mensaje</p>
                    </div>
                    <div class="mx-7">
                        <!-- Formulario -->
                        <form action="{{url('contactar/'.$user->id)}}" method="post" class="w-full lg:w-9/12 mx-auto text-black">
                            @csrf
                            <!-- Email Address -->
                            <div class="my-4">
                                <label for="email" class="text-2xl">Email</label>
                                <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="email" type="email" name="email" value="{{$user->email}}" required />
                            </div> 
                            <div class="my-4">
                                <label for="subject" class="text-2xl">Asunto</label>
                                <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="subject" type="text" name="subject" value="" placeholder="Resolución de verificación..." required />
                            </div>
                            <!-- Text Area -->
                            <div class="my-4">
                                <label for="email" class="text-2xl">Mensaje</label>
                                <textarea class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="email" name="message" required></textarea>
                            </div>

                            <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                            type="submit"
                            value="Enviar">
                        </form>
                    </div>
                </div>

                <!-- Verificaciones -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Verificaciones</p>
                    </div>
                    <div class="mx-7">
                        <!-- Tabla -->
                        <table class="w-full text-black">
                            <tr class="border-b-2">
                                <th class="border-r-2 border-l-2">
                                    <p class="text-left text-sm sm:text-base | pl-2">DNI/NIE</p>
                                </th>
                                <th class="border-r-2 border-l-2">
                                    <p class="text-left text-sm sm:text-base | pl-2">Estado</p>
                                </th>
                                <th class="border-r-2 border-l-2">
                                    <p class="text-left text-sm sm:text-base | pl-2">Fecha de creacion</p>
                                </th>
                            </tr>
                            @foreach($verifications as $transaction) 
                                <tr class="border-b-2">
                                    <td class="border-r-2 border-l-2">
                                        <p class="text-sm sm:text-base | pl-2">{{$transaction->num_id}}</p>
                                    </td>
                                    <td class="border-r-2 border-l-2">
                                        <p class="text-sm sm:text-base | pl-2">{{$transaction->request_state}}</p>
                                    </td>
                                    <td class="border-r-2 border-l-2">
                                        <p class="text-sm sm:text-base | pl-2">{{$transaction->created_at}}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <!-- Transacciones -->
                <div class="w-full sm:w-10/12 | my-5 | bg-white | rounded | h-full">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-center mb-3">Transacciones</p>
                    </div>
                    <div class="mx-7">
                        <div class="hidden lg:block">
                            <table class="w-full text-black">
                                <tr class="border-b-2">
                                    <th class="border-r-2 border-l-2">
                                        <p class="text-left text-sm sm:text-base | pl-2">Id de Pago</p>
                                    </th>
                                    <th class="border-r-2 border-l-2">
                                        <p class="text-left text-sm sm:text-base | pl-2">Payer id</p>
                                    </th>
                                    <th class="border-r-2 border-l-2">
                                        <p class="text-left text-sm sm:text-base | pl-2">Token</p>
                                    </th>
                                    <th class="border-r-2 border-l-2">
                                        <p class="text-left text-sm sm:text-base | pl-2">Costo</p>
                                    </th>
                                    <th class="border-r-2 border-l-2">
                                        <p class="text-left text-sm sm:text-base | pl-2">Estado</p>
                                    </th>
                                    <th class="border-r-2 border-l-2">
                                        <p class="text-left text-sm sm:text-base | pl-2">Fecha de creacion</p>
                                    </th>
                                </tr>
                                @foreach($transactions as $transaction) 
                                    <tr class="border-b-2">
                                        <td class="border-r-2 border-l-2">
                                            <p class="text-sm sm:text-base | pl-2">{{$transaction->payment_id}}</p>
                                        </td>
                                        <td class="border-r-2 border-l-2">
                                            <p class="text-sm sm:text-base | pl-2">{{$transaction->payer_id}}</p>
                                        </td>
                                        <td class="border-r-2 border-l-2">
                                            <p class="text-sm sm:text-base | pl-2">{{$transaction->token}}</p>
                                        </td>
                                        <td class="border-r-2 border-l-2">
                                            <p class="text-sm sm:text-base | pl-2">{{$transaction->amount}} €</p>
                                        </td>
                                        <td class="border-r-2 border-l-2">
                                            <p class="text-sm sm:text-base | pl-2">{{$transaction->state}}</p>
                                        </td>
                                        <td class="border-r-2 border-l-2">
                                            <p class="text-xs sm:text-base | pl-2">{{$transaction->created_at}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="block lg:hidden">
                            Importante: Para ver correctamente todos los datos es mejor utilizar un ordenador...
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('layouts.footer')

        <script id="functions" src="{{ asset('js/recomendedAuthorsJS.js') }}" defer></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    </body>
</html>