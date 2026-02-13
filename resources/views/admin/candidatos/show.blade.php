<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Candidato: {{ $candidato->nombre }} {{ $candidato->apellidos }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6 space-y-6">

                {{-- FOTO --}}
                @if($candidato->foto)
                <div>
                    <img src="{{ asset($candidato->foto) }}" alt="Foto del candidato"
                        class="w-32 h-32 rounded-full object-cover border">
                </div>
                @endif

                {{-- DATOS PERSONALES --}}
                <h3 class="text-lg font-semibold">Datos personales</h3>

                <ul class="space-y-2">
                    <li><strong>ID:</strong> {{ $candidato->id }}</li>
                    <li><strong>Nombre:</strong> {{ $candidato->nombre }}</li>
                    <li><strong>Apellidos:</strong> {{ $candidato->apellidos }}</li>
                    <li><strong>Email:</strong> {{ $candidato->email }}</li>
                    <li><strong>Teléfono:</strong> {{ $candidato->telefono }}</li>
                    <li><strong>DNI:</strong> {{ $candidato->dni }}</li>
                    <li><strong>Fecha nacimiento:</strong> {{ $candidato->fecha_nacimiento }}</li>
                </ul>

                {{-- DIRECCIÓN --}}
                <h3 class="text-lg font-semibold mt-6">Dirección</h3>

                <ul class="space-y-2">
                    <li><strong>Dirección:</strong> {{ $candidato->direccion }}</li>
                    <li><strong>CP:</strong> {{ $candidato->cp }}</li>
                    <li><strong>Ciudad:</strong> {{ $candidato->ciudad }}</li>
                    <li><strong>Provincia:</strong> {{ $candidato->provincia }}</li>
                </ul>

                {{-- INFO EXTRA --}}
                <h3 class="text-lg font-semibold mt-6">Información adicional</h3>

                <ul class="space-y-2">
                    <li><strong>LinkedIn:</strong> {{ $candidato->linkedin }}</li>
                    <li><strong>Web:</strong> {{ $candidato->web }}</li>
                </ul>

                {{-- CV --}}
                <h3 class="text-lg font-semibold mt-6">Currículum</h3>

                @if($candidato->cv)
                <a href="{{ asset($candidato->cv) }}" target="_blank"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Descargar CV
                </a>
                @else
                <p class="text-gray-500">No hay CV subido.</p>
                @endif

                {{-- BOTONES --}}
                <div class="mt-6">
                    <a href="{{ route('admin.candidatos.edit', $candidato) }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Editar candidato
                    </a>

                    <a href="{{ route('admin.candidatos.index') }}"
                        class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>