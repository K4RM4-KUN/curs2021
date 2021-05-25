<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Términos y políticas</title>

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
                href="{{url('nosotros')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 |  bg-white hover:bg-gray-100 hover:text-gray-600">
                    <p>GENERAL</p>
                </a> 
                <a 
                href="{{url('terminos/uso')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 | @if($type == 'uso')bg-gray-100 text-gray-600 @else bg-white hover:bg-gray-100 hover:text-gray-600 @endif ">
                    <p>TÉRMINOS DE USO</p>
                </a> 
                <a 
                href="{{url('terminos/privacidad')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 | @if($type == 'privacidad')bg-gray-100 text-gray-600 @else bg-white hover:bg-gray-100 hover:text-gray-600 @endif ">
                    <p>POLÍTICA DE PRIVACIDAD</p>
                </a>  
                <a 
                href="{{url('terminos/comunidad')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 | @if($type == 'comunidad')bg-gray-100 text-gray-600 @else bg-white hover:bg-gray-100 hover:text-gray-600 @endif ">
                    <p >POLÍTICA DE COMUNIDAD</p>
                </a>  
                <a 
                href="{{url('terminos/cookies')}}"
                class="flex justify-center items-center | h-24 w-full sm:w-2/12 | @if($type == 'cookies')bg-gray-100 text-gray-600 @else bg-white hover:bg-gray-100 hover:text-gray-600 @endif ">
                    <p>POLÍTICA DE COOKIES</p>
                </a> 
            </div>
            <!--AboutUs Content-->
            <div class="w-full sm:w-10/12 bg-white bg-opacity-70 shadow-xl text-justify">
                <!--AboutUs Terminos de uso-->
                <div class="@if($type != 'uso') hidden @endif w-full px-10 pt-3 pb-10 | text-sm">
                    <p class="text-ourBlue text-2xl font-bold text-left p-2">Términos de uso</p>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Aceptación de los Términos del Servicio y Normas de la Comunidad que a continuación se
                        detallan:</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">POR FAVOR LEA CON DETENIMIENTO LAS CONDICIONES DE USO ANTES DE UTILIZAR EL PRESENTE SITIO.
                        PUEDEN PARECERLE MUY TÉCNICAS Y FORMALES DESDE EL PUNTO DE VISTA LEGAL PERO SON DE VITAL
                        IMPORTANCIA. AL UTILIZAR ESTE SITIO, UD. ACEPTA ESTAS CONDICIONES DE USO. EN CASO DE QUE UD. NO
                        ESTE DE ACUERDO CON ESTAS CONDICIONES DE USO, POR FAVOR NO UTILICE ESTE SITIO O LOS SERVICIOS
                        QUE EL MISMO LE OFRECE. GRACIAS.</p>
                    <ol class="px-4">
                        <li class="pb-2">1. La aceptación a estos términos del servicio (“Términos de Servicio”) es un acuerdo legal
                            vinculante entre usted y la EMPRESA respecto al uso del Sitio Web y todos los productos o
                            servicios disponibles del Sitio Web. Por favor, lea estos Términos de Servicio
                            cuidadosamente. Al acceder o utilizar el Sitio Web, usted expresa su acuerdo con (1) los
                            Términos del Servicio, y (2) las Normas de la comunidad incorporadas y detalladas en las
                            presentes condiciones generales. Si no está de acuerdo con cualquiera de estos términos o
                            las Normas de la comunidad, por favor, no utilice este sitio o los servicios que el mismo
                            ofrece.
                        </li>
                        <li class="pb-2">2. Actualización de los Términos del Servicio. Aunque intentaremos notificar a los lectores
                            cuando se realizan cambios importantes a las presentes Condiciones de Servicio, usted debe
                            revisar periódicamente la versión vigente más actualizada de las Condiciones del servicio.
                            La EMPRESA, a su discreción, puede modificar o revisar estas Condiciones de servicio y
                            políticas en cualquier momento, y usted acepta que quedará vinculado por estas
                            modificaciones o revisiones.
                        </li>
                        <li class="pb-2">3. Las presentes Condiciones de Servicio se aplican a todos los usuarios del Sitio Web,
                            incluidos los usuarios que participen aportando contenidos tales como imágenes, información
                            y otros materiales o servicios en el Sitio Web.
                        </li>
                        <li class="pb-2">4. La EMPRESA se reserva el derecho a modificar cualquier aspecto del Sitio Web en cualquier
                            momento.
                        </li>
                    </ol>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Propiedad intelectual e industrial del Sitio Web</h2>
                    <ol class="px-4 space-y-2">
                        <li>La EMPRESA es titular de los derechos de propiedad intelectual e industrial, o ha
                            obtenido las autorizaciones o licencias correspondientes para su explotación, sobre
                            el nombre de dominio, las marcas y signos distintivos, la aplicación y el resto de
                            obras e invenciones asociadas con el sitio web y la tecnología asociada al mismo,
                            así como sobre sus contenidos, con excepción de las obras y contenidos generados por
                            los usuarios, que pertenecen a sus correspondientes autores, sin perjuicio de los
                            derechos de explotación de los mismos que corresponden a la EMPRESA.</li>
                        <li>Los contenidos de este sitio web, incluyendo diseños, aplicaciones, texto,
                            imágenes, cómics y código fuente (“Contenido”), están protegidos por derechos de
                        propiedad intelectual.</li>
                        <li>El contenido del Sitio web se proporciona TAL CUAL para su información y uso solamente personal y no puede ser usado, copiado, reproducido, distribuido, transmitido, emitido, exhibido, vendido, licenciado, o explotado para ningún otro propósito sin el previo consentimiento por escrito de los respectivos titulares. La web se reserva todos los derechos no expresamente en y para el Sitio web y los contenidos. Usted se compromete a no participar en el uso, copia o distribución de cualquier contenido que no sea expresamente permitido aquí, incluyendo cualquier uso, copia, o distribución de Archivos de usuario de terceros obtenidos a través del Sitio web para usos comerciales. Si usted descarga o imprime una copia del contenido para uso personal, debe conservar todos los derechos de autor y otros avisos de propiedad incluidos en el mismo. Usted se compromete a no eludir, desactivar o interferir con las características relacionadas con la seguridad del Sitio web o las características de la web que previenen o restringen el uso o copia de cualquier contenido o imponen limitaciones en el uso del Sitio web o su contenido.</li>
                        <li>LA EMPRESA no cede ni comparte de forma voluntaria las publicaciones aqui realizadas por parte de los usuarios. Si usted considera que el contenido del SITIO WEB está siendo copiado o distribuido en otras webs o aplicaciones, le recomendamos que deje de visitar esas webs que copian el contenido y perjudican a los usuarios que han realizado las publicaciones originalmente en este SITIO WEB. El contenido aquí expuesto se proporciona de forma pública únicamente por parte de los usuarios del SITIO WEB para uso personal y no se cede, vende o permite la copia o el uso de este contenido ninguna web o aplicación de terceros</li>
                        <li>La titularidad de los contenidos, respuestas y comentarios introducidos por los
                            usuarios pertenece a sus correspondientes autores. La EMPRESA no se responsabiliza
                        de las opiniones emitidas por los autores de dichos contenidos.</li>
                        <li>En caso de que Vd solicite a la EMPRESA la obtención de la información –incluidos
                            los textos, imágenes y cualquier otra obra sometida a derechos de propiedad
                            intelectual o industrial- asociada a su perfil en otras redes sociales, grupos,
                            foros o servicios, mediante la comunicación de su nombre de usuario, la EMPRESA
                            iniciará a cabo las medidas técnicas necesarias para el cumplimiento de dicho
                            mandato, obteniendo los datos públicos y/o privados asociados a su perfil en su
                            nombre y representación, y vinculando a su perfil en los sitios web
                            correspondientes. La EMPRESA no asume responsabilidad alguna derivada del uso que
                            Vd. u otros usuarios pueda efectuar de la información obtenida en cumplimiento del
                            mandato descrito en este apartado. El usuario será el único responsable del uso de
                            la información obtenida a través del procedimiento descrito y deberá adoptar las
                            medidas oportunas para evitar que dicho uso pueda constituir una infracción de
                            derechos de propiedad intelectual o industrial de terceros.
                        </li>
                        <li>Las marcas de terceros que, eventualmente, pueden aparecer en el sitio web
                            pertenecen a los terceros titulares de las mismas.
                        </li>
                    </ol>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Propiedad Intelectual de los Archivos de Usuarios</h2>
                    <ol class="px-4 space-y-2">
                        <li>Usted puede enviar imágenes y texto (“Comentarios de usuarios”) al Sitio Web. Las
                            fotos, comentarios o cualquier otra obra o material que incorporen los usuarios se
                            conocen colectivamente como “Archivos de Usuario”.
                        </li>
                        <li>2. Usted acepta que en caso de ser publicados dichos Archivos de Usuario, serán
                            puestos a libre disposición del resto de usuarios del Sitio Web, sin limitación
                            alguna.
                        </li>
                        <li>El Usuario es el único responsable de los Archivos de Usuario remitidos y acepta
                            las consecuencias de su envío al Sitio Web y de su publicación. El usuario afirma, y
                            / o garantiza ser dueño y/o disponer de todos los derechos necesarios para la
                            publicación de los archivos de Usuario en el Sitio Web, autorizando, por tanto, a la
                            empresa para su comunicación pública, uso y explotación en la forma que estimen
                            conveniente, sin limitación alguna geográfica o temporal.
                        </li>
                        <li>Dicha autorización, que, en su caso, revestirá la forma legal de licencia
                            perpetua, irrevocable, mundial, no exclusiva, gratuita, sublicenciable y
                            transferible para usar, reproducir, distribuir, modificar, adaptar, traducir y, bajo
                            cualquier otra forma, explotar los Archivos de Usuario, incluida la promoción y
                            redistribución de parte o la totalidad del Sitio web en cualquier formato y a través
                            de cualquier canal de comunicación.
                        </li>
                        <li>Cualquier tercero distinto de la EMPRESA o de las personas físicas o jurídicas
                            expresamente autorizadas por la misma que pretenda extraer, usar, publicar o
                            explotar, bajo cualquier forma, los contenidos generados por los usuarios, deberá
                            recabar, previa y expresamente, el consentimiento de sus titulares o, en su caso, de
                            la EMPRESA.
                        </li>
                        <li>El Usuario se compromete a no presentar material alguno que ostente derechos de
                            propiedad intelectual o industrial o que estén protegidos por el secreto comercial o
                            de cualquier otro tipo, incluyendo la privacidad y derechos de publicidad, salvo en
                            el caso de que sea el propietario de dichos derechos o tenga el permiso de su
                            titular para publicar el material y conceder al Sitio Web todos los derechos de
                            licencia otorgados en este documento.
                        </li>
                    </ol>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Copyright / Propiedad intelectual</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        Si usted es un titular de derechos de autor o un agente del titular del derecho de autor
                        y cree que un envío de usuario u otro contenido en nuestro sitio web infringe sus
                        derechos de autor de la propiedad intelectual derechos de autor, usted puede enviar un
                        reporte de abuso o DMCA a copyright@tumangaonline.com para su revisión. No necesitamos
                        que envíes un formal DMCA, una simple correo explicando que el tema es suficiente.
                        Un correo por DMCA requiere la siguiente información:
                        una firma física o electrónica de una persona autorizada para actuar en nombre del
                        titular de un derecho exclusivo que presuntamente se está infringiendo
                        identificación del trabajo con derechos de copyright vulnerados
                        información suficientemente para establecer contacto con usted, tales como: dirección,
                        número de teléfono y correo electrónico
                        Una declaración con la confirmación de que la información aportada es exacta bajo pena
                        de perjurio y que usted está autorizado para actuar en nombre del titular de un derecho
                        exclusivo que presuntamente se ha infringido.
                    </p>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Exclusión de responsabilidad</h2>
                    <ol class="px-4 space-y-2">
                        <li>El Usuario entiende que al utilizar el Sitio Web, la EMPRESA no es responsable de la
                            exactitud, utilidad, seguridad o derechos de propiedad intelectual de o en relación con
                            los Archivos de Usuario. El Usuario entiende y reconoce que los Archivos de Usuarios
                            pueden resultar inexactos, ofensivos y en algunos casos resultar indecentes o
                            censurables.
                        </li>
                        <li>El Sitio Web puede contener enlaces a sitios web de terceros que no son propiedad o
                            no son controladas por la EMPRESA, quien carece de control sobre, y no asume ninguna
                            responsabilidad por el contenido, políticas de privacidad o prácticas de los sitios web
                            de terceros. Además, la EMPRESA no puede censurar o editar el contenido de cualquier
                            sitio de terceros. Mediante el uso del Sitio Web expresamente excluye a la EMPRESA de
                            toda y cualquier responsabilidad que surja del uso de cualquier sitio web de terceros.
                        </li>
                        <li>La EMPRESA no comparte ni hace propios, de manera enumerativa pero no limitativa, los
                            envíos de usuario ni las entradas, comentarios, recomendaciones, consejos y opiniones
                            expresados en los Archivos de Usuario, eximiéndose la EMPRESA de toda responsabilidad
                            que se produzca por la publicación en el Sitio Web de los Archivos de los Usuarios.
                        </li>
                        <li>El Sitio Web no permite las actividades infractoras de los derechos de autor en su
                            Sitio Web, y la EMPRESA tiene la potestad de borrar todos los contenidos y envíos de
                            usuario que infrinjan estos derechos. El Sitio Web se reserva el derecho de eliminar
                            Contenido de Usuario sin previo aviso, en caso de que existan dudas acerca del
                            cumplimiento de las presentes condiciones de uso.
                        </li>
                    </ol>
                    <p class=" mt-5"><i>Última Actualización: 18/5/2021</i></p>
                </div>
                <!--AboutUs Politica de privacidad-->
                <div class="@if($type != 'privacidad') hidden @endif w-full px-10 pt-3 pb-10 | text-sm">
                    <p class="text-ourBlue text-2xl font-bold text-left p-2">Política de privacidad</p>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">En esta declaración de privacidad te explicamos qué datos personales recogemos de nuestros
                        usuarios y cómo los utilizamos. Te animamos a leer detenidamente estos términos antes de
                        facilitar tus datos personales en esta web.</p>

                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Advertencia para menores de edad</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        La utilización de la Página Web no está dirigida a menores de 14 años y, por consiguiente, éstos
                        deberán abstenerse de facilitar cualquier información de carácter personal. En este sentido,
                        NovelAir recomienda la utilización de su Página Web a personas mayores de 18 años.
                        Si eres menor de trece años y has accedido a este sitio web sin avisar a tus padres no debes
                        registrarte como usuario.</p>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        NovelAir se reserva el derecho a comprobar en cualquier momento la edad de los usuarios de su
                        Página Web.</p>

                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Datos recabados</h2>
                    <ul class="px-4 space-y-2">
                        <li>· Nombre de usuario (no es necesario que se corresponda a nombre y apellidos reales, solo lo
                            necesitamos para que puedas acceder y para dirigirnos a ti de alguna forma).
                        </li>
                        <li>· Nombre y apellidos (Necesarios para verificar según propiedad intelectual de la obra).
                        </li>
                        <li>· Correo electrónico (Para poder ponernos en contacto con usted en caso de que sea necesario y
                            la
                            cual no se visualiza en el modo de perfil público)
                        </li>
                        <li>· Contraseña (Encriptada y a la que no tenemos acceso, tampoco se mostrará en modo de perfil
                            público)
                        </li>
                        <li>· Género</li>
                        <li>· Fecha de nacimiento</li>
                        <li>· Perfiles de redes sociales</li>
                        <p class="text-gray-700 text-xs px-5 py-2 text-justify">Esta información se cede de forma voluntaria por parte de los usuarios en el momento del
                        registro en la web y ha excepción del correo electrónico y contraseña que son necesario para
                        poder realizar el registro, el resto de datos no son obligatorios.</p>
                        
                    </ul>

                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">¿Con qué finalidad tratamos tus datos personales?</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                    En el caso que usted se haya registrado en nuestra página Web, las finalidades para las cuales
                    trataremos sus Datos de carácter personal son:</p>
                    <ul class="px-4 space-y-2">
                        <li>
                        </li><li>· Gestionar su alta y sus preferencias de usuario, así como para prestarle los servicios de
                            nuestra página Web que Usted haya solicitado. La base de legitimación que habilita a NovelAir SL
                             a tratar sus datos para la presente finalidad es su solicitud de registro.
                        </li>
                        <li>· Gestionar las quejas y consultas sobre nuestra Página Web</li>
                        <li>· Centralización o interconexión entre los distintos productos y servicios de NovelAir.
                        </li>
                        <li>· Para velar por el buen uso de nuestros servicios y productos, impidiendo que se lleven a
                            cabo
                            usos ilícitos o contrarios a nuestra política y valores, pudiendo incluso darle de baja como
                            usuario registrado. La base legitimadora de dicho tratamiento es el cumplimiento por parte
                            de
                            NovelAir de determinadas obligaciones legales, así como el interés legítimo de proteger
                            nuestros servicios y productos.
                        </li>
                    </ul>

                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">¿Cuánto tiempo conservamos tus datos personales?</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">Si usted no se ha registrado en nuestra página web
                    </p><ul class="px-4 space-y-2">
                        <li>· Los datos personales relativos a sus hábitos de navegación o de consumo que podamos haber
                            obtenido de terceros serán mantenidos mientras usted no revoque el consentimiento otorgado a
                            estos terceros.
                        </li>
                        <li>· Si usted se ha registrado en nuestra página web<br>
                            Los Datos personales que tratamos se conservarán mientras Usted no cancele su cuenta.<br>
                            Los datos personales recabados para velar por el buen uso de nuestros servicios o resolver
                            una
                            consulta o incidencia se conservarán hasta que se haya resuelto la consulta o incidencia
                            correspondiente.
                        </li>
                    </ul>

                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">¿Cuáles son tus derechos?</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">Las personas interesadas tienen derecho a:</p> 
                    <ul class="px-4 space-y-2">
                        <li>· Derecho de acceso: Tienes derecho a confirmar que estamos tratando tus datos personales y,
                            si en
                            caso afirmativo, a obtener una copia de dichos datos e información completa sobre el
                            tratamiento.
                        </li>
                        <li>· Derecho de rectificación: Tienes derecho a corregir errores, modificar los datos inexactos o
                            incompletos y garantizar la certeza de la información objeto de tratamiento.
                        </li>
                        <li>· Derecho de supresión:Tienes derecho a solicitar la supresión de tus datos sin dilación
                            indebida,
                            en caso que el tratamiento sea ilícito o la finalidad que motivó su tratamiento o recogida
                            hubiera desaparecido.
                        </li>
                        <li>· Derecho de limitación del tratamiento:Tienes derecho a solicitar la suspensión del
                            tratamiento
                            en caso de que éste sea ilícito o la exactitud de los datos haya sido impugnada.
                        </li><li>· Derecho de oposición:Tienes derecho a oponerte al tratamiento de tus datos cuando tenga por
                            objeto el marketing directo o cuando deba cesar el tratamiento por motivos relacionados con
                            tu
                            situación personal, salvo que se acredite un interés legítimo o sea necesario para el
                            ejercicio
                            o defensa de reclamaciones.
                        </li>
                    </ul>
                    <p class="mt-5"><i>Última Actualización: 18/5/2021</i></p>
                </div>
                <!--AboutUs Politica de comunidad-->
                <div class="@if($type != 'comunidad') hidden @endif w-full px-10 pt-3 pb-10 | text-sm">
                    <p class="text-ourBlue text-2xl font-bold text-left p-2">Política de comunidad</p>
                    <p></p>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Aceptación de los Términos del Servicio y Normas de la Comunidad que a continuación se
                        detallan:</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">POR FAVOR LEA CON DETENIMIENTO LAS CONDICIONES DE USO ANTES DE UTILIZAR EL PRESENTE SITIO.
                        PUEDEN PARECERLE MUY TÉCNICAS Y FORMALES DESDE EL PUNTO DE VISTA LEGAL PERO SON DE VITAL
                        IMPORTANCIA. AL UTILIZAR ESTE SITIO, UD. ACEPTA ESTAS CONDICIONES DE USO. EN CASO DE QUE UD. NO
                        ESTE DE ACUERDO CON ESTAS CONDICIONES DE USO, POR FAVOR NO UTILICE ESTE SITIO O LOS SERVICIOS
                        QUE EL MISMO LE OFRECE. GRACIAS.</p>
                    <ol class="px-4"> 
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Normas de la Comunidad</h2>
                    <ol class="px-4">
                        <li class="pb-2">1. El Usuario se compromete a cumplir con los términos y condiciones de estos Términos de
                            Servicio, Normas de la comunidad, y todas las leyes locales, nacionales y reglamentos
                            internacionales.
                        </li>
                        <li class="pb-2">2. El Usuario se compromete a no hacerse pasar por otra persona u organización, lo que puede
                            constituir un delito de suplantación de identidad de acuerdo con el Código Penal Español.
                        </li>
                        <li class="pb-2">3. El Usuario se compromete a no acosar a cualquier otro usuario y utilizar un lenguaje
                            respetuoso y no ofensivo con el resto de Usuarios.
                        </li>
                        <li class="pb-2">4. El Usuario se compromete a no eludir, desactivar o interferir en las funciones
                            relacionadas con la seguridad del Sitio Web que impidan o limiten el uso o copia de
                            cualquier Contenido o hacer cumplir las limitaciones del uso del Sitio web o su Contenido en
                            el mismo.
                        </li>
                        <li class="pb-2">5. No se permite el uso de la firma o avatar como medio de promoción o publicidad de
                            productos, servicios, programas de afiliados o webs, en el caso de que contengan publicidad
                            o tengan fines comerciales.
                        </li>
                        <li class="pb-2">6. No se permite el uso de múltiples cuentas por un mismo usuario salvo casos excepcionales
                            autorizados por un administrador o motivos justificados (múltiples usuarios en un mismo
                            ordenador, etc). La detección de este hecho puede dar lugar al bloqueo de todas las cuentas
                            asociadas al mismo usuario y/o bloqueo permanente de acceso.
                        </li>
                        <li class="pb-2">7. El uso de esta web como medio para organizar ataques o spam a cualquier tipo de servicio
                            (foros, webs, etc) no está permitido. Ese tipo de contenidos podrán ser eliminados y las
                            cuentas que incumplan esta norma podrán ser igualmente canceladas.
                        </li>
                        <li class="pb-2">8. El administrador y moderadores del sitio web tienen el derecho a borrar, editar, mover o
                            cerrar cualquier contenido y/o cuenta de usuario que incumpla cualquier de las normas y
                            obligaciones descritas en estos términos legales o pueda ser considerado inapropiado por la
                            EMPRESA.
                        </li>
                        <li class="pb-2">9. No son admisibles mensajes con amenazas, insultos graves o cualquier otro tipo de
                            comentario que pueda herir la sensibilidad del destinatario. En tal caso, nos reservamos el
                            derecho de avisar a las autoridades pertinentes.
                        </li>
                        <li class="pb-2">10. Los envíos de usuario debe cumplir la Política de contenido de Google Adsense. Si una
                            aportación no cumple con la misma, podrá ser eliminada.
                        </li>
                        <li class="pb-2">11. Usted acepta que su comportamiento en el Sitio Web atiende a las normas de la comunidad
                            que serán actualizadas periódicamente. Le rogamos que periódicamente las consulte.
                        </li>
                    </ol> 
                    <p class="mt-5"><i>Última Actualización: 18/5/2021</i></p>
                </div>
                <!--AboutUs Politica de privacidad-->
                <div class="@if($type != 'cookies') hidden @endif w-full px-10 pt-3 pb-10 | text-sm">
                    <p class="text-ourBlue text-2xl font-bold text-left p-2">Política de cookies</p>  
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">NovelAir SL informa acerca del uso de las cookies en sus páginas webs</p>

                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">¿Qué son las cookies?</h2>

                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">Las cookies son archivos que se pueden descargar en su equipo a través de las páginas web. Son
                        herramientas que tienen un papel esencial para la prestación de numerosos servicios de la
                        sociedad
                        de la información. Entre otros, permiten a una página web almacenar y recuperar información
                        sobre
                        los hábitos de navegación de un usuario o de su equipo y, dependiendo de la información
                        obtenida, se
                        pueden utilizar para reconocer al usuario y mejorar el servicio ofrecido.</p>

                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Tipos de cookies</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">Según quien sea la entidad que gestione el dominio desde donde se envían las cookies y trate los
                        datos que se obtengan se pueden distinguir dos tipos:</p>
                    <ul class="px-4 space-y-2">
                        <li>· Cookies propias: aquéllas que se envían al equipo terminal del usuario desde un equipo o
                            dominio
                            gestionado por el propio editor y desde el que se presta el servicio solicitado por el
                            usuario.
                        </li>
                        <li>· Cookies de terceros: aquéllas que se envían al equipo terminal del usuario desde un equipo
                            o
                            dominio
                            que no es gestionado por el editor, sino por otra entidad que trata los datos obtenidos
                            través
                            de
                            las cookies.
                        </li>
                    </ul>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        En el caso de que las cookies sean instaladas desde un equipo o dominio gestionado por el propio
                        editor pero la información que se recoja mediante éstas sea gestionada por un tercero, no pueden
                        ser
                        consideradas como cookies propias.</p>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        Existe también una segunda clasificación según el plazo de tiempo que permanecen almacenadas en
                        el
                        navegador del cliente, pudiendo tratarse de:</p>
                    <ul class="px-4 space-y-2">
                        <li>· Cookies de sesión: diseñadas para recabar y almacenar datos mientras el usuario accede a una
                            página
                            web. Se suelen emplear para almacenar información que solo interesa conservar para la
                            prestación
                            del
                            servicio solicitado por el usuario en una sola ocasión (p.e. una lista de productos
                            adquiridos).
                        </li>
                        <li>· Cookies persistentes: los datos siguen almacenados en el terminal y pueden ser accedidos y
                            tratados
                            durante un periodo definido por el responsable de la cookie, y que puede ir de unos minutos
                            a
                            varios
                            años.
                        </li>
                    </ul>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        Por último, existe otra clasificación con cinco tipos de cookies según la finalidad para la que
                        se
                        traten los datos obtenidos:</p>
                    <ul class="px-4 space-y-2">
                        <li>
                            · Cookies técnicas: aquellas que permiten al usuario la navegación a través de una página web,
                            plataforma o aplicación y la utilización de las diferentes opciones o servicios que en ella
                            existan
                            como, por ejemplo, controlar el tráfico y la comunicación de datos, identificar la sesión,
                            acceder a
                            partes de acceso restringido, recordar los elementos que integran un pedido, realizar el
                            proceso
                            de
                            compra de un pedido, realizar la solicitud de inscripción o participación en un evento,
                            utilizar
                            elementos de seguridad durante la navegación, almacenar contenidos para la difusión de
                            vídeos o
                            sonido o compartir contenidos a través de redes sociales.
                        </li>
                        <li>· Cookies de personalización: permiten al usuario acceder al servicio con algunas
                            características
                            de
                            carácter general predefinidas en función de una serie de criterios en el terminal del
                            usuario
                            como
                            por ejemplo serian el idioma, el tipo de navegador a través del cual accede al servicio, la
                            configuración regional desde donde accede al servicio, etc.
                        </li>
                        <li>· Cookies de análisis: permiten al responsable de las mismas, el seguimiento y análisis del
                            comportamiento de los usuarios de los sitios web a los que están vinculadas. La información
                            recogida
                            mediante este tipo de cookies se utiliza en la medición de la actividad de los sitios web,
                            aplicación o plataforma y para la elaboración de perfiles de navegación de los usuarios de
                            dichos
                            sitios, aplicaciones y plataformas, con el fin de introducir mejoras en función del análisis
                            de
                            los
                            datos de uso que hacen los usuarios del servicio.
                        </li><li>· Cookies publicitarias: permiten la gestión, de la forma más eficaz posible, de los espacios
                            publicitarios.
                        </li>
                        <li>· Cookies de publicidad comportamental: almacenan información del comportamiento de los
                            usuarios
                            obtenida a través de la observación continuada de sus hábitos de navegación, lo que permite
                            desarrollar un perfil específico para mostrar publicidad en función del mismo.
                        </li>
                        <li>· Cookies de redes sociales externas: se utilizan para que los visitantes puedan interactuar
                            con
                            el
                            contenido de diferentes plataformas sociales (facebook, youtube, twitter, linkedIn, etc..) y
                            que
                            se
                            generen únicamente para los usuarios de dichas redes sociales. Las condiciones de
                            utilización de
                            estas cookies y la información recopilada se regula por la política de privacidad de la
                            plataforma
                            social correspondiente.
                        </li>
                    </ul>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Desactivación y eliminación de cookies</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">Tienes la opción de permitir, bloquear o eliminar las cookies instaladas en tu equipo mediante la
                        configuración de las opciones del navegador instalado en su equipo. Al desactivar cookies,
                        algunos
                        de los servicios disponibles podrían dejar de estar operativos.</p>

                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">La forma de deshabilitar las cookies es diferente para cada navegador, pero normalmente puede
                        hacerse desde el menú Herramientas u Opciones. También puede consultarse el menú de Ayuda del
                        navegador dónde puedes encontrar instrucciones. El usuario podrá en cualquier momento elegir qué
                        cookies quiere que funcionen en este sitio web.</p>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        Puede usted permitir, bloquear o eliminar las cookies instaladas en su equipo mediante la
                        configuración de las opciones del navegador instalado en su ordenador:</p>
                    <ul class="px-4 space-y-2">
                        <li>· Microsoft Internet Explorer o Microsoft Edge:</li>
                        http://windows.microsoft.com/es-es/windows-vista/Block-or-allow-cookies
                        <li>· Mozilla Firefox:
                            http://support.mozilla.org/es/kb/impedir-que-los-sitios-web-guarden-sus-preferencia
                        </li>
                        <li>· Chrome: https://support.google.com/accounts/answer/61416?hl=es</li>
                        <li>· Safari: http://safari.helpmax.net/es/privacidad-y-seguridad/como-gestionar-las-cookies/</li>
                        <li>· Opera: http://help.opera.com/Linux/10.60/es-ES/cookies.html Además, también puede gestionar
                            el
                            almacén de cookies en su navegador a través de herramientas como las siguientes
                        </li>
                    </ul>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2"> Cookies utilizadas</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">A continuación se identifican las cookies que están siendo utilizadas en este portal así como su
                        tipología y función:</p>
                    <ul class="px-4 space-y-2">
                        <li>· Cookies de sesión</li>
                        <li>· Cookies técnicas</li>
                        <li>· Cookies de personalización</li>
                        <li>· Cookies publicitarias</li>
                        <li>· Cookies de redes sociales externas</li>
                    </ul>
                    <h2 class="text-ourBlue text-lg font-bold text-left p-2">Aceptación de la Política de cookies</h2>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        La web asume que usted acepta el uso de cookies. No obstante, muestra información sobre su
                        Política
                        de cookies en la parte inferior o superior de cualquier página del portal con cada inicio de
                        sesión
                        con el objeto de que usted sea consciente.</p>
                    <p class="text-gray-700 text-xs px-5 py-2 text-justify">
                        Ante esta información es posible llevar a cabo las siguientes acciones:</p>
                    <ul class="px-4 space-y-2">
                        <li>· Aceptar cookies. No se volverá a visualizar este aviso al acceder a cualquier página del
                            portal
                            durante la presente sesión.
                        </li>
                        <li>· Cerrar. Se oculta el aviso en la presente página.</li>
                        <li>· Modificar su configuración.</li>
                    </ul>
                    <p class="mt-5"><i>Última Actualización: 18/5/2021</i></p>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </body>
</html>
