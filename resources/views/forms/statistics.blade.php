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
        <!-- Encabezado -->
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
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
        </div>
    </div>
</x-app-layout>
