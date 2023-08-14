<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Califica al maestro ') }} {{ $form->teacher->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($existingSubmission)
                    <div class="alert alert-info">
                        Ya has contestado este formulario.
                    </div>
                @else
                <h2 class="text-lg font-semibold mb-4">{{ $form->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $form->description }}</p>
                <form method="POST" action="{{ route('forms.submit', ['form' => $form->id]) }}">
                    @csrf

                    @foreach ($form->formQuestions as $question)
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">{{ $question->question }}</label>
                            @foreach ($question->multipleChoices as $choice)
                                <label class="inline-flex items-center mt-2">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" class="form-radio h-5 w-5 text-indigo-600">
                                    <span class="ml-2">{{ $choice->answer }}</span>
                                </label>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Enviar Respuestas') }}
                        </x-button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
