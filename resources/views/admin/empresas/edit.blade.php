<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modificar Empresa: {{ $empresa->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <form method="POST" action="{{ route('admin.empresas.update', $empresa) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2 bg-gray-50 p-4 rounded-lg border border-dashed">
                            <label class="block text-xs font-bold text-gray-500 uppercase">Logo de la empresa</label>
                            <input type="file" name="logo" class="mt-2 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Nombre Comercial</label>
                            <input type="text" name="nombre" value="{{ $empresa->nombre }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">CIF</label>
                            <input type="text" name="cif" value="{{ $empresa->cif }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Persona de Contacto</label>
                            <input type="text" name="persona_contacto" value="{{ $empresa->persona_contacto }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Email Corporativo</label>
                            <input type="email" name="email_contacto" value="{{ $empresa->email_contacto }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Teléfono</label>
                            <input type="text" name="telefono" value="{{ $empresa->telefono }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Estado de Verificación</label>
                            <select name="verificada" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 font-bold">
                                <option value="1" {{ $empresa->verificada ? 'selected' : '' }}>SÍ - VERIFICADA</option>
                                <option value="0" {{ !$empresa->verificada ? 'selected' : '' }}>NO - PENDIENTE</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase">Dirección</label>
                            <input type="text" name="direccion" value="{{ $empresa->direccion }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="grid grid-cols-3 sm:col-span-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">CP</label>
                                <input type="text" name="cp" value="{{ $empresa->cp }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Ciudad</label>
                                <input type="text" name="ciudad" value="{{ $empresa->ciudad }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Provincia</label>
                                <input type="text" name="provincia" value="{{ $empresa->provincia }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase">Web oficial</label>
                            <input type="text" name="web" value="{{ $empresa->web }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50 border-t flex items-center">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg font-bold text-xs uppercase hover:bg-green-700 transition shadow-md">
                            Guardar Cambios
                        </button>
                        <a href="{{ route('admin.empresas.show', $empresa) }}" class="ml-4 text-sm font-bold text-gray-500 hover:text-gray-700 uppercase">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>