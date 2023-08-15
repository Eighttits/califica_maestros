<x-app-layout>
        <style>
        .question {

            margin-bottom: 20px;
        }
        
        .choices-container {
            display: flex;
        }
        
        .choices {
            flex: 1;
            padding-right: 20px;
        }
        
        .bars-container {
            padding-top: 10px;
            flex: 2;
            display: flex;
            flex-direction: column;
        }
        
        .bar {
            height: 20px;
            background-color: #06873e;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            transition: width 0.3s ease-in-out;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Alinea el contenido hacia la izquierda */
            overflow: hidden;
        }
        
        .bar-text {
            color: rgb(0, 0, 0);
            font-size: 14px;
            white-space: nowrap;
            overflow: visible; /* Permite que el texto se desborde */
            text-overflow: clip; /* No agrega puntos suspensivos, muestra el texto completo */
            padding: 0 4px; /* Agrega un pequeño espaciado entre el texto y la barra */
        }
        
        
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selecciona un formulario') }}
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
                <h3 class="text-lg font-semibold mb-4">{{ __('Selecciona un formulario') }}</h3>
                <form action="{{ route('forms.statistics.select') }}" method="get">
                    @csrf
                    <label for="form_id" class="block text-gray-700 text-sm font-bold mb-2">Formulario:</label>
                    <select name="form_id" id="form_id" class="block w-full p-2 border rounded-md">
                        @foreach ($forms as $form)
                            <option value="{{ $form->id }}">{{ $form->title }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="mt-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 focus:bg-blue-400 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Ver Estadísticas
                    </button>
                </form>

                @isset($statistics)
                <div class="mt-5 border-t-4 border-black pt-5">
                @foreach ($statistics as $question)
                
                    @php
                        $totalResponses = collect($question['choices'])->sum('count');
                    @endphp
                
                    <div class="question">
                        <p class="question-text">{{ $question['question'] }}</p>
                    </div>
                    <div class="choices-container">
                        <div class="choices">
                            @foreach ($question['choices'] as $choice)
                                <div class="choice">
                                    <div class="choice-info">
                                        <p class="choice-text">{{ $choice['choice'] }} ({{ $choice['count'] }})</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="bars-container border border-black rounded">
                            @foreach ($question['choices'] as $choice)
                                <div class="bar" style="width: {{ $totalResponses !== 0 ? ($choice['count'] / $totalResponses) * 100 : 0 }}%;">
                                    <div class="bar-text">
                                        {{ $choice['choice'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                
                @endforeach
                </div>
                @endisset
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