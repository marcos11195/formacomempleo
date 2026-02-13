<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Empresa: {{ $empresa->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6 space-y-4">

                <h3 class="text-lg font-semibold">Datos de la empresa</h3>

                <ul class="space-y-2">
                    <li><strong>ID:</strong> {{ $empresa->id }}</li>
                    <li><strong>Nombre:</strong> {{ $empresa->nombre }}</li>
                    <li><strong>Persona de contacto:</strong> {{ $empresa->persona_contacto }}</li>
                    <li><strong>Email:</strong> {{ $empresa->email_contacto }}</li>
                    <li><strong>Teléfono:</strong> {{ $empresa->telefono }}</li>
                    <li><strong>CIF:</strong> {{ $empresa->cif }}</li>
                    <li><strong>Dirección:</strong> {{ $empresa->direccion }}</li>
                    <li><strong>CP:</strong> {{ $empresa->cp }}</li>
                    <li><strong>Ciudad:</strong> {{ $empresa->ciudad }}</li>
                    <li><strong>Provincia:</strong> {{ $empresa->provincia }}</li>
                    <li><strong>Web:</strong> {{ $empresa->web }}</li>
                    <li><strong>Verificada:</strong>
                        @if($empresa->verificada)
                        <span class="text-green-600 font-semibold">Sí</span>
                        @else
                        <span class="text-red-600 font-semibold">No</span>
                        @endif
                    </li>
                </ul>

                {{-- LOGO --}}
                @if($empresa->logo)
                <div class="mt-4">
                    <strong>Logo:</strong><br>
                    <img src="{{ asset($empresa->logo) }}" alt="Logo de la empresa" class="w-32 h-32 object-contain border rounded">
                </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('admin.empresas.edit', $empresa) }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Editar empresa
                    </a>

                    <a href="{{ route('admin.empresas.index') }}"
                        class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>