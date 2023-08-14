<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido al panel de administración,') }} {{ auth()->user()->name }}
        </h2>
    </x-slot>
    
    <div class="flex justify-end mr-4 mb-4 mt-3">
        <a href="{{ route('add-student') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Agregar alumno</a>
        <a href="{{ route('create-form') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Agregar formulario</a>
    </div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                <div class="bg-green-200 text-green-800 p-4 mb-4" id="success-message">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-200 text-red-800 p-4 mb-4" id="error-message">
                        {{ session('error') }}
                    </div>
                @endif
                <h3 class="text-lg font-semibold mb-4">Administrar Formularios y Alumnos</h3>
                <div class="grid grid-cols-2 gap-6">
                    <a href="{{ route('forms.list') }}" class="block bg-green-500 hover:bg-green-600 focus:bg-green-600 text-white font-semibold py-6 px-8 rounded transition duration-300 ease-in-out">
                        Ver Formularios
                    </a>
                    <a href="{{ route('students.list') }}" class="block bg-green-500 hover:bg-green-600 focus:bg-green-600 text-white font-semibold py-6 px-8 rounded transition duration-300 ease-in-out">
                        Ver Estudiantes
                    </a>
                    <a href="{{ route('add-techer-student') }}" class="block bg-blue-500 hover:bg-blue-600 focus:bg-blue-600 text-white font-semibold py-6 px-8 rounded transition duration-300 ease-in-out" style="background-color: #013C6E;">
                        Vincular Maestro con Estudiante
                    </a>
                    <a href="#" class="block bg-blue-500 hover:bg-blue-600 focus:bg-blue-600 text-white font-semibold py-6 px-8 rounded transition duration-300 ease-in-out" style="background-color: #013C6E;">
                        Ver Estadísticas
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // Función para ocultar el mensaje después de un tiempo
    function hideMessage() {
        var successMessage = document.getElementById('success-message');
        var errorMessage = document.getElementById('error-message');

        if (successMessage) {
            successMessage.style.display = 'none';
        }

        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }

    // Ocultar el mensaje después de 5 segundos (5000 milisegundos)
    setTimeout(hideMessage, 5000);
</script>
