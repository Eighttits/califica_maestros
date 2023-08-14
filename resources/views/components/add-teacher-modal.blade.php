<div>
    <h2 class="text-xl font-semibold mb-4">Agregar Maestro</h2>
    <form method="POST" action="{{ route('add-teacher') }}">
        @csrf
        <input type="text" name="name" class="border rounded px-2 py-1 w-full mb-2" placeholder="Nombre del Maestro">

        <!-- Botones -->
        <div class="mt-4 flex justify-end">
            <button @click="$refs.teacherModal.style.display = 'none'" class="text-gray-600 mr-2">Cancelar</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>