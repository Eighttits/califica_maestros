<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro Exitoso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('Registro Exitoso') }}</h3>
                <p>{{ __('Gracias por utilizar UnivamReview. A continuación, encontrarás la información de tu cuenta:') }}</p>
                
                <div class="mt-4">
                    <p><strong>{{ __('Correo Electrónico:') }}</strong> {{ $email }}</p>
                    <p><strong>{{ __('Contraseña Temporal:') }}</strong> {{ $temporaryPassword }}</p>
                </div>
                
                <p class="mt-4">{{ __('Por favor, inicia sesión con tu correo electrónico y la contraseña temporal proporcionada. Te recomendamos cambiar tu contraseña lo más pronto posible para mayor seguridad.') }}</p>
            </div>
        </div>
    </div>
</x-guest-layout>
