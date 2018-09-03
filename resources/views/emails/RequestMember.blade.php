@component('mail::message')
    ##New member Request

    UserName  : {{ $request_username }}

    Instructions:
    {{ $instruction }}

@endcomponent
