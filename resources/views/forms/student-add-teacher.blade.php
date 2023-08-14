<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Profesores a Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('user.add-teachers') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">
                            Seleccionar Usuario (Alumno):
                        </label>
                        <select name="user_id" id="user_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Seleccionar Profesores:
                        </label>
                        @foreach ($teachers as $teacher)
                            <label class="inline-flex items-center mt-2">
                                <input type="checkbox" name="teacher_ids[]" value="{{ $teacher->id }}" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2">{{ $teacher->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Agregar Profesores') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
