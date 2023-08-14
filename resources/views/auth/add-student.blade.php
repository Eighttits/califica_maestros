<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                    <div class="bg-green-200 text-green-800 p-4 mb-4">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-200 text-red-800 p-4 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register-student') }}">
                        @csrf

                        <div>
                            <x-label for="name" value="{{ __('Nombre') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                {{ __('Agregar Estudiante') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
