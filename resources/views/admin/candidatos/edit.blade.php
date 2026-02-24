<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar candidato: {{ $candidato->nombre }} {{ $candidato->apellidos }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                {{-- AÑADIDO: enctype="multipart/form-data" para permitir subida de archivos --}}
                <form method="POST" action="{{ route('admin.candidatos.update', $candidato) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- CAMPO DE IMAGEN/FOTO --}}
                        <div class="sm:col-span-2 flex items-center space-x-4 mb-4 p-4 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <div class="flex-shrink-0">
                                @if($candidato->foto)
                                <img src="{{ asset($candidato->foto) }}" class="w-20 h-20 rounded-full object-cover border-2 border-white shadow-sm">
                                @else
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">Sin foto</div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Cambiar foto de perfil</label>
                                <input type="file" name="foto" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Formatos admitidos: JPG, PNG. Máximo 2MB.</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $candidato->nombre) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Apellidos</label>
                            <input type="text" name="apellidos" value="{{ old('apellidos', $candidato->apellidos) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $candidato->email) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $candidato->telefono) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">DNI</label>
                            <input type="text" name="dni" value="{{ old('dni', $candidato->dni) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha nacimiento</label>
                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $candidato->fecha_nacimiento) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion', $candidato->direccion) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">CP</label>
                            <input type="text" name="cp" value="{{ old('cp', $candidato->cp) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ciudad</label>
                            <input type="text" name="ciudad" value="{{ old('ciudad', $candidato->ciudad) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provincia</label>
                            <input type="text" name="provincia" value="{{ old('provincia', $candidato->provincia) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">LinkedIn</label>
                            <input type="text" name="linkedin" value="{{ old('linkedin', $candidato->linkedin) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Web</label>
                            <input type="text" name="web" value="{{ old('web', $candidato->web) }}"
                                class="mt-1 block w-full border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>

                    </div>

                    <div class="mt-6 border-t pt-4">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white font-bold text-xs uppercase rounded hover:bg-green-700 transition shadow-sm">
                            Guardar cambios
                        </button>

                        <a href="{{ route('admin.candidatos.show', $candidato) }}"
                            class="ml-3 px-6 py-2 bg-gray-300 text-gray-700 font-bold text-xs uppercase rounded hover:bg-gray-400 transition">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>