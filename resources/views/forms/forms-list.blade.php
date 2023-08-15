<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Formularios') }}
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
                <h2 class="text-lg font-semibold mb-4">{{ __('Formularios Registrados') }}</h2>
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Título') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Maestro') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Acciones') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($forms as $form)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $form->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $form->teacher['name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('forms.edit', $form->id) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                                        <button class="text-red-600 hover:underline" onclick="deleteForm({{ $form->id }})">Eliminar</button>
                                        <form id="delete-form-{{ $form->id }}" action="{{ route('forms.destroy', $form->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            {{--  @method('DELETE')  --}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function deleteForm(formId) {
        if (confirm('¿Estás seguro de que deseas eliminar este formulario?')) {
            document.getElementById('delete-form-' + formId).submit();
        }
    }

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