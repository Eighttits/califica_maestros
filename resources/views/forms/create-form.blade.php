<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Formulario') }}
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
                <form method="POST" action="{{ route('admin.save-form') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                            Título del formulario:
                        </label>
                        <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            required autofocus />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                            Descripción del formulario:
                        </label>
                        <textarea name="description" id="description"
                            class="form-input rounded-md shadow-sm mt-1 block w-full" rows="4"
                            required></textarea>
                    </div>
                    <div class="mb-4 flex">
                        <div>
                            <label for="teacher" class="block text-gray-700 text-sm font-bold mb-2">
                                Maestro a evaluar:
                            </label>
                            <input type="text" name="teacher" id="teacher" class="form-input rounded-md shadow-sm mt-1 block w-full" required autofocus />
                        </div>
                    </div>
                    
                    

                    <div class="mb-4 ml-5">
                        <button type="button" id="addQuestion" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 focus:bg-blue-400 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Agregar Pregunta
                        </button>
                    </div>

                    
                    <div id="questionsContainer">
                        <!-- Aquí se agregarán dinámicamente las preguntas -->
                    </div>

                    <!-- Aquí podrías agregar campos para las preguntas del formulario -->

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Guardar Formulario') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- ... -->
<!-- ... -->
<!-- ... -->
<!-- ... -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const questionsContainer = document.getElementById('questionsContainer');
    const addQuestionButton = document.getElementById('addQuestion');
    let questionCounter = 0;
    let alphabet = "abcdefghijklmnopqrstuvwxyz";

    function getNextLetter(answerCounter) {
        let index = answerCounter % alphabet.length;
        return alphabet[index];
    }

    addQuestionButton.addEventListener('click', function () {


        const questionId = `${questionCounter}`;
        const questionDiv = document.createElement('div');
        questionDiv.className = 'mb-4 border border-black rounded p-4 ml-5 mr-5';

        const questionLabel = document.createElement('label');
        questionLabel.textContent = `Pregunta ${questionCounter + 1}:`;
        questionLabel.className = 'block text-gray-700 text-sm font-bold mb-2';

        const questionInput = document.createElement('input');
        questionInput.type = 'text';
        questionInput.name = `questions[${questionCounter}]`;
        questionInput.placeholder = `Escribe aqui tu pregunta`;
        questionInput.className = 'form-input rounded-md shadow-sm mt-1 block w-full';
        questionInput.required = true;

        const addAnswerButton = document.createElement('button');
        addAnswerButton.textContent = 'Agregar respuesta';
        addAnswerButton.className = 'mt-2 mb-2 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 focus:bg-blue-400 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';

        const answersDiv = document.createElement('div');
        answersDiv.className = 'mb-4 grid grid-cols-2 gap-4';

        questionDiv.appendChild(questionLabel);
        questionDiv.appendChild(questionInput);
        questionDiv.appendChild(addAnswerButton)
        questionDiv.appendChild(answersDiv);
        questionsContainer.appendChild(questionDiv);

        addAnswerButton.addEventListener('click', function () {
          //  const questionId = $questionCounter;
          //  console.log($questionId);
            const answerLetter = getNextLetter(answersDiv.children.length);

            const answerDiv = document.createElement('div');
            answerDiv.className = '';

            const answerLabel = document.createElement('label');
            answerLabel.textContent = `Respuesta ${answerLetter}:`;
            answerLabel.className = 'block text-gray-700 text-sm font-bold mb-2';

            const answerInput = document.createElement('input');
            answerInput.type = 'text';
            answerInput.name = `answers[${questionId}][${answersDiv.children.length}]`;
            answerInput.className = 'form-input rounded-md shadow-sm mt-1 block w-full';
            answerInput.required = true;

            answerDiv.appendChild(answerLabel);
            answerDiv.appendChild(answerInput);
            answersDiv.appendChild(answerDiv);
        });

        questionCounter++; // Incrementar el contador de preguntas aquí
    });
});

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
<!-- ... -->

<!-- ... -->

<!-- ... -->

<!-- ... -->



