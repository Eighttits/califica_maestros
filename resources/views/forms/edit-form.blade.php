<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Formulario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">{{ __('Editar Formulario: ') }} {{ $form->title }}</h2>
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
                <form method="POST" action="{{ route('forms.update', $form->id) }}">
                    @csrf
                    @method('PUT')

                    <label class="block font-medium text-gray-700">{{ __('Título') }}</label>
                    <input type="text" name="title" value="{{ $form->title }}" class="form-input mt-2 w-full">

                    <label class="block font-medium text-gray-700 mt-4">{{ __('Descripción') }}</label>
                    <textarea name="description" class="form-input mt-2 w-full">{{ $form->description }}</textarea>

                    {{-- Agregar campos para editar preguntas y respuestas aquí --}}
                    @foreach ($form->formQuestions as $question)
                        <label class="block font-medium text-gray-700 mt-4">{{ __('Pregunta') }}</label>
                        <input type="text" name="questions[{{ $question->id }}]" value="{{ $question->question }}" class="form-input mt-2 w-full">

                        <label class="block font-medium text-gray-700 mt-4">{{ __('Respuestas') }}</label>
                        @foreach ($question->multipleChoices as $choice)
                            <input type="text" name="answers[{{ $question->id }}][{{ $choice->id }}]" value="{{ $choice->answer }}" class="form-input mt-2 w-full">
                        @endforeach
                    @endforeach
                    
                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Guardar Cambios') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
