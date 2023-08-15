@component('mail::message')
# Registro Exitoso
Gracias por utilizar UnivamReview. A continuación, encontrarás la información de tu cuenta:

Correo Electrónico: {{ $email }} <br>
Contraseña Temporal: {{ $temporaryPassword }}

@component('mail::subcopy')
Por favor, inicia sesión con tu correo electrónico y la contraseña temporal proporcionada. Te recomendamos cambiar tu contraseña lo más pronto posible para mayor seguridad.
@endcomponent

@component('mail::button', ['url' => 'http://univamreview.sytes.net'])
    Ir a UnivamReview
@endcomponent




Thanks,<br>
{{ config('app.name') }}
@endcomponent