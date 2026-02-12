<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Editar perfil</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('candidato.update') }}">
                @csrf
                @method('PUT')

                <label class="block mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ $candidato->nombre }}"
                    class="w-full border rounded px-3 py-2 mb-4">

                <label class="block mb-2">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded px-3 py-2 mb-4">{{ $candidato->descripcion }}</textarea>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
            </form>

        </div>
    </div>
</x-app-layout>