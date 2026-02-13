<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar empresa: {{ $empresa->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.empresas.update', $empresa) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div>
                            <label>Nombre</label>
                            <input type="text" name="nombre" value="{{ $empresa->nombre }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Persona de contacto</label>
                            <input type="text" name="persona_contacto" value="{{ $empresa->persona_contacto }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Email de contacto</label>
                            <input type="email" name="email_contacto" value="{{ $empresa->email_contacto }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Teléfono</label>
                            <input type="text" name="telefono" value="{{ $empresa->telefono }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>CIF</label>
                            <input type="text" name="cif" value="{{ $empresa->cif }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div class="sm:col-span-2">
                            <label>Dirección</label>
                            <input type="text" name="direccion" value="{{ $empresa->direccion }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Código Postal</label>
                            <input type="text" name="cp" value="{{ $empresa->cp }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Ciudad</label>
                            <input type="text" name="ciudad" value="{{ $empresa->ciudad }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Provincia</label>
                            <input type="text" name="provincia" value="{{ $empresa->provincia }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div class="sm:col-span-2">
                            <label>Web</label>
                            <input type="text" name="web" value="{{ $empresa->web }}"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div class="sm:col-span-2">
                            <label>Logo (opcional)</label>
                            <input type="file" name="logo"
                                class="mt-1 block w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Verificada</label>
                            <select name="verificada" class="mt-1 block w-full border rounded p-2">
                                <option value="1" @if($empresa->verificada) selected @endif>Sí</option>
                                <option value="0" @if(!$empresa->verificada) selected @endif>No</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-6">
                        <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Guardar cambios
                        </button>

                        <a href="{{ route('admin.empresas.show', $empresa) }}"
                            class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>