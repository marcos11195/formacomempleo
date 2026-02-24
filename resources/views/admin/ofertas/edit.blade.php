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
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="titulo" value="{{ old('titulo', $oferta->titulo) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $oferta->descripcion) }}</textarea>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Requisitos</label>
                            <textarea name="requisitos" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('requisitos', $oferta->requisitos) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Salario Mínimo (€)</label>
                            <input type="number" name="salario_min" value="{{ old('salario_min', $oferta->salario_min) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Salario Máximo (€)</label>
                            <input type="number" name="salario_max" value="{{ old('salario_max', $oferta->salario_max) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach(['borrador', 'publicada', 'pausada', 'cerrada', 'vencida'] as $estado)
                                <option value="{{ $estado }}" @selected(old('estado', $oferta->estado) == $estado)>
                                    {{ ucfirst($estado) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="mt-8 flex items-center">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white font-bold rounded shadow-sm hover:bg-green-700 transition">
                            Guardar cambios
                        </button>

                        <a href="{{ route('admin.ofertas.show', $oferta) }}"
                            class="ml-3 px-6 py-2 bg-gray-300 text-gray-700 font-bold rounded hover:bg-gray-400 transition">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>