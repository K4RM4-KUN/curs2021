<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
    <body class="bg-gradient-to-br from-gray-400 to-gray-200 min-h-screen""> 
            <!--@@include('layouts.navigationNew')-->
            @include('layouts.navigationNew')
        <div class="flex flex-col justify-center items-center | w-full">    
            <!--AboutUs Content-->
            <div class="w-1/1 sm:w-6/12 h-1/1 bg-white shadow-xl">
                <!--AboutUs General-->
                <div class="flex flex-col justify-center items-center | px-10 pt-3 pb-10 | text-sm">
                        <p class="my-2 text-justify">{{session('status')}}</p>
                        @if($transaction->state == "approved")
                            <div class=" border-b-2 border-ourBlue mb-5">
                                <div class="flex my-1">
                                    <p class="text-gray-700">Estado del pago:&nbsp&nbsp</p> <p>{{$transaction->state}}</p>
                                </div>
                                <div class="flex my-1">
                                    <p class="text-gray-700">Id del pago:&nbsp&nbsp</p> <p>{{$transaction->payment_id}}</p>
                                </div>
                                <div class="flex my-1">
                                    <p class="text-gray-700">Payer id:&nbsp&nbsp </p> <p>{{$transaction->payer_id}}</p>
                                </div>
                                <div class="flex my-1">
                                    <p class="text-gray-700">Token del pago:&nbsp&nbsp </p> <p>{{$transaction->token}}</p>
                                </div>
                                <div class="flex my-1">
                                    <p class="text-gray-700">Suma pagada:&nbsp&nbsp </p> <p>{{$transaction->amount}}€</p>
                                </div>
                                <div class="flex my-1">
                                    <p class="text-gray-700">Pagado a&nbsp&nbsp </p> <p>{{$transaction->email}}</p>
                                </div>
                                <div class="flex my-1">
                                    <p class="text-gray-700">Fecha del pago:&nbsp&nbsp </p> <p>{{$transaction->created_at}}</p>
                                </div>
                                <div class="flex my-1">
                                    <p class="text-gray-700">Activa hasta:&nbsp&nbsp </p> <p>{{$subscription->caducate_at}}</p>
                                </div>
                                <div class="my-2">
                                    <p class="text-center">Puedes guardar esto como si fuera una factura...</p>
                                </div>
                            </div>
                    @endif
                        <p class="my-2">Si quieres ver todas transacciones haz click aqui:</p>
                        <a class="my-2 | bg-ourBlue text-white border-2 border-blue-400 font-bold" 
                        href="{{url('usuario/ajustes/subscripciones')}}">
                            <p class="px-2 py-1 text-base">Tus transacciones!</p>
                        </a>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </body>
</html>
