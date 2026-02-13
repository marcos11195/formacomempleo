<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inscripción — Oferta {{ $inscripcion->idoferta }} / Candidato {{ $inscripcion->idcandidato }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6 space-y-6">

                {{-- FECHA --}}
                <p><strong>Fecha de inscripción:</strong> {{ $inscripcion->fecha_inscripcion }}</p>

                {{-- CANDIDATO --}}
                <h3 class="text-lg font-semibold mt-6">Candidato</h3>

                @if($inscripcion->candidato)
                <ul class="space-y-2">
                    <li><strong>Nombre:</strong> {{ $inscripcion->candidato->nombre }} {{ $inscripcion->candidato->apellidos }}</li>
                    <li><strong>Email:</strong> {{ $inscripcion->candidato->email }}</li>
                    <li><strong>Teléfono:</strong> {{ $inscripcion->candidato->telefono }}</li>
                    <li><strong>Ciudad:</strong> {{ $inscripcion->candidato->ciudad }}</li>
                    <li><strong>Provincia:</strong> {{ $inscripcion->candidato->provincia }}</li>
                </ul>

                <a href="{{ route('admin.candidatos.show', $inscripcion->candidato) }}"
                    class="text-blue-600 hover:underline">
                    Ver perfil completo del candidato
                </a>
                @else
                <p class="text-red-600">Candidato eliminado</p>
                @endif

                {{-- OFERTA --}}
                <h3 class="text-lg font-semibold mt-6">Oferta</h3>

                @if($inscripcion->oferta)
                <ul class="space-y-2">
                    <li><strong>Título:</strong> {{ $inscripcion->oferta->titulo }}</li>
                    <li><strong>Descripción:</strong> {{ $inscripcion->oferta->descripcion }}</li>
                    <li><strong>Requisitos:</strong> {{ $inscripcion->oferta->requisitos }}</li>
                    <li><strong>Salario:</strong> {{ $inscripcion->oferta->salario }}</li>
                    <li><strong>Estado:</strong>
                        @if($inscripcion->oferta->estado)
                        <span class="text-green-600 font-semibold">Activa</span>
                        @else
                        <span class="text-red-600 font-semibold">Inactiva</span>
                        @endif
                    </li>
                </ul>

                <a href="{{ route('admin.ofertas.show', $inscripcion->oferta) }}"
                    class="text-blue-600 hover:underline">
                    Ver oferta completa
                </a>
                @else
                <p class="text-red-600">Oferta eliminada</p>
                @endif

                {{-- EMPRESA --}}
                <h3 class="text-lg font-semibold mt-6">Empresa</h3>

                @if($inscripcion->oferta && $inscripcion->oferta->empresa)
                <ul class="space-y-2">
                    <li><strong>Nombre:</strong> {{ $inscripcion->oferta->empresa->nombre }}</li>
                    <li><strong>Email:</strong> {{ $inscripcion->oferta->empresa->email }}</li>
                    <li><strong>Teléfono:</strong> {{ $inscripcion->oferta->empresa->telefono }}</li>
                    <li><strong>Ciudad:</strong> {{ $inscripcion->oferta->empresa->ciudad }}</li>
                </ul>

                <a href="{{ route('admin.empresas.show', $inscripcion->oferta->empresa) }}"
                    class="text-blue-600 hover:underline">
                    Ver empresa
                </a>
                @else
                <p class="text-red-600">Empresa no disponible</p>
                @endif

                {{-- BOTONES --}}
                <div class="mt-6">
                    <a href="{{ route('admin.inscripciones.index') }}"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>