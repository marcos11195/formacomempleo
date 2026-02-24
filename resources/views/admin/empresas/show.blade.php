<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ficha de Empresa: {{ $empresa->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-700 uppercase">Información Corporativa</h3>
                    @if($empresa->verificada)
                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded font-bold">VERIFICADA</span>
                    @endif
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold">Nombre / CIF</p>
                            <p class="text-gray-900">{{ $empresa->nombre }} <span class="text-gray-400">({{ $empresa->cif }})</span></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold">Persona de Contacto</p>
                            <p class="text-gray-900">{{ $empresa->persona_contacto }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold">Email de contacto</p>
                            <p class="text-indigo-600 font-medium">{{ $empresa->email_contacto }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold">Teléfono</p>
                            <p class="text-gray-900">{{ $empresa->telefono }}</p>
                        </div>
                    </div>

                    <div class="space-y-4 border-l pl-6 border-gray-100">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold">Ubicación</p>
                            <p class="text-gray-900">{{ $empresa->direccion }}</p>
                            <p class="text-gray-600 text-sm">{{ $empresa->cp }}, {{ $empresa->ciudad }} ({{ $empresa->provincia }})</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold">Sitio Web</p>
                            <a href="{{ $empresa->web }}" target="_blank" class="text-blue-600 hover:underline">{{ $empresa->web ?? 'No especificada' }}</a>
                        </div>
                        @if($empresa->logo)
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold mb-2">Logo Corporativo</p>
                            <img src="{{ asset($empresa->logo) }}" class="w-32 h-20 object-contain border rounded p-2 bg-gray-50">
                        </div>
                        @endif
                    </div>
                </div>

                <div class="p-6 bg-gray-50 flex border-t">
                    <a href="{{ route('admin.empresas.edit', $empresa) }}"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-bold text-xs uppercase hover:bg-indigo-700 transition">
                        Editar Empresa
                    </a>
                    <a href="{{ route('admin.empresas.index') }}"
                        class="ml-3 px-6 py-2 bg-white border border-gray-300 text-gray-600 rounded-lg font-bold text-xs uppercase hover:bg-gray-100 transition">
                        Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>