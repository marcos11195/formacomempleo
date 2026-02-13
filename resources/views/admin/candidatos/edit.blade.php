<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar candidato: {{ $candidato->nombre }} {{ $candidato->apellidos }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.candidatos.update', $candidato) }}">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div>
                            <label>Nombre</label>
                            <input type="text" name="nombre" value="{{ $candidato->nombre }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" value="{{ $candidato->apellidos }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $candidato->email }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Teléfono</label>
                            <input type="text" name="telefono" value="{{ $candidato->telefono }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>DNI</label>
                            <input type="text" name="dni" value="{{ $candidato->dni }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Fecha nacimiento</label>
                            <input type="date" name="fecha_nacimiento" value="{{ $candidato->fecha_nacimiento }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div class="sm:col-span-2">
                            <label>Dirección</label>
                            <input type="text" name="direccion" value="{{ $candidato->direccion }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>CP</label>
                            <input type="text" name="cp" value="{{ $candidato->cp }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Ciudad</label>
                            <input type="text" name="ciudad" value="{{ $candidato->ciudad }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Provincia</label>
                            <input type="text" name="provincia" value="{{ $candidato->provincia }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>LinkedIn</label>
                            <input type="text" name="linkedin" value="{{ $candidato->linkedin }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Web</label>
                            <input type="text" name="web" value="{{ $candidato->web }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                    </div>

                    <div class="mt-6">
                        <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Guardar cambios
                        </button>

                        <a href="{{ route('admin.candidatos.show', $candidato) }}"
                            class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>