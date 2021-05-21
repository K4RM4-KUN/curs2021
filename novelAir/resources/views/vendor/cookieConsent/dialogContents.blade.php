<div class="js-cookie-consent cookie-consent | fixed bottom-0 z-50
bg-gray-100 | w-full h-32 | flex flex-col justify-center items-center | border-b-8 border-gray-200">

    <span class="cookie-consent__message | 
    mb-3 | font-bold text-gray-600">
        {!! trans('cookieConsent::texts.message') !!}
    </span>

    <button class="js-cookie-consent-agree cookie-consent__agree |
    py-1 px-3 | border-2 border-ourBlue | bg-ourBlue hover:bg-gray-100 | text-white font-bold hover:text-ourBlue">
        {{ trans('cookieConsent::texts.agree') }}
    </button>

</div>
