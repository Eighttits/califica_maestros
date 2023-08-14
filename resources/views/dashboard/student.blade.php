<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido a UnivamReview, ') }} {{ auth()->user()->name }}
        </h2>
    </x-slot>

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

                <h3 class="font-semibold text-lg mb-4">Formularios asignados:</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach (auth()->user()->teachers as $teacher)
                        @foreach ($teacher->forms as $form)
                        <a href="{{ route('forms.student-form', ['formId' => $form->id]) }}">
                            <div class="bg-green-500 hover:bg-green-600 focus:bg-green-600 font-semibold text-white p-4 rounded-lg">
                                
                                    {{ $form->title }}
                               
                            </div>
                        </a>
                        @endforeach
                    @endforeach
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