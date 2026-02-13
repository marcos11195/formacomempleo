<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar oferta: {{ $oferta->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.ofertas.update', $oferta) }}">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="sm:col-span-2">
                            <label>Título</label>
                            <input type="text" name="titulo" value="{{ $oferta->titulo }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div class="sm:col-span-2">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="4"
                                class="mt-1 block w-full border rounded p-2">{{ $oferta->descripcion }}</textarea>
                        </div>

                        <div class="sm:col-span-2">
                            <label>Requisitos</label>
                            <textarea name="requisitos" rows="4"
                                class="mt-1 block w-full border rounded p-2">{{ $oferta->requisitos }}</textarea>
                        </div>

                        <div>
                            <label>Salario</label>
                            <input type="text" name="salario" value="{{ $oferta->salario }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Estado</label>
                            <select name="estado" class="mt-1 block w-full border rounded p-2">
                                <option value="1" @if($oferta->estado) selected @endif>Activa</option>
                                <option value="0" @if(!$oferta->estado) selected @endif>Inactiva</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-6">
                        <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Guardar cambios
                        </button>

                        <a href="{{ route('admin.ofertas.show', $oferta) }}"
                            class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>