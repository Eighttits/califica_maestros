<x-guest-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #374151;" class="leading-tight">
            {{ __('Registro Exitoso') }}
        </h2>
    </x-slot>

    <div style="padding: 3rem 0;" class="py-12">
        <div style="max-width: 48rem; margin: 0 auto;" class="max-w-full sm:px-6 lg:px-8">
            <div style="background-color: #fff; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden;" class="bg-white overflow-hidden sm:rounded-lg p-6">
                <h3 style="font-weight: 600; font-size: 1.125rem; color: #4a5568;" class="mb-4">{{ __('Registro Exitoso') }}</h3>
                <p style="color: #4a5568;">{{ __('Gracias por utilizar UnivamReview. A continuación, encontrarás la información de tu cuenta:') }}</p>
                
                <div style="margin-top: 1rem; color: #4a5568;" class="mt-4">
                    <p><strong>{{ __('Correo Electrónico:') }}</strong> {{ $email }}</p>
                    <p><strong>{{ __('Contraseña Temporal:') }}</strong> {{ $temporaryPassword }}</p>
                    <a href="http://univamreview.sytes.net">UnivamReview</a>
                </div>
                
                <p style="margin-top: 1rem; color: #4a5568;" class="mt-4">{{ __('Por favor, inicia sesión con tu correo electrónico y la contraseña temporal proporcionada. Te recomendamos cambiar tu contraseña lo más pronto posible para mayor seguridad.') }}</p>
            </div>
        </div>
    </div>
</x-guest-layout>
