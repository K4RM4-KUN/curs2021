<style>
html {
  min-height: 100%;
  position: relative;
}
body {
  margin: 0;
  margin-bottom: 250px;
}
.footerCSS {
  position: absolute;
  bottom: 0;
  width: 100%;
}
</style>

<footer class="footer-1 bg-white pt-8 sm:pt-6 mt-10 border-t-4 w-full border-ourBlue footerCSS">
    <div class="flex flex-col">
        <div class="flex flex-wrap w-full justify-center text-ourBlue divide-x">
            <div class="px-5">
                <a href="{{url('nosotros/info')}}">Nosotros</a>
            </div>

            <div class="px-5">
                <a href="{{url('nosotros/contactanos')}}">Contactanos</a>
            </div>

            <div class="px-5">
                <a href="{{url('terminos/uso')}}">Terminos y políticas</a>
            </div>

            <div class="px-5">
                <a href="{{url('terminos/privacidad')}}">Privacidad</a>
            </div>

            <div class="px-5">
                <a href="{{url('terminos/comunidad')}}">Comunidad</a>
            </div>

            <div class="px-5">
                <a href="{{url('terminos/cookies')}}">Cookies</a>
            </div>
        </div>

        <div class="flex | w-full mt-5 | justify-center | text-gray-500">
            <p>ⓒ NOVEL AIR Entertainment Inc.</p>
        </div>

        <div class="flex | w-full mt-5 | justify-center | text-gray-500">
            <a href="{{url('/')}}"><img class="w-32" src="{{asset('images/logo2.png')}}" alt="logo"></a>
        </div>
    </div>
</footer>