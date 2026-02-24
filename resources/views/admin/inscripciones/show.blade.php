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
                <div class="bg-gray-50 p-4 rounded">
                    <p><strong>Fecha de inscripción:</strong> {{ \Carbon\Carbon::parse($inscripcion->fecha_inscripcion)->format('d/m/Y H:i') }}</p>
                </div>

                {{-- CANDIDATO --}}
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-indigo-700">Candidato</h3>
                    @if($inscripcion->candidato)
                    <ul class="mt-2 space-y-1 text-sm">
                        <li><strong>Nombre:</strong> {{ $inscripcion->candidato->nombre }} {{ $inscripcion->candidato->apellidos }}</li>
                        <li><strong>Email:</strong> {{ $inscripcion->candidato->email }}</li>
                        <li><strong>Teléfono:</strong> {{ $inscripcion->candidato->telefono }}</li>
                        <li><strong>Ubicación:</strong> {{ $inscripcion->candidato->ciudad }} ({{ $inscripcion->candidato->provincia }})</li>
                    </ul>
                    <div class="mt-3">
                        <a href="{{ route('admin.candidatos.show', $inscripcion->candidato) }}" class="text-blue-600 text-sm hover:underline">
                            Ver perfil completo del candidato &rarr;
                        </a>
                    </div>
                    @else
                    <p class="text-red-600">Candidato eliminado</p>
                    @endif
                </div>

                {{-- OFERTA --}}
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-indigo-700">Oferta</h3>
                    @if($inscripcion->oferta)
                    <ul class="mt-2 space-y-1 text-sm">
                        <li><strong>Título:</strong> {{ $inscripcion->oferta->titulo }}</li>

                        {{-- SALARIO CORREGIDO --}}
                        <li><strong>Salario:</strong>
                            @if($inscripcion->oferta->salario_min)
                            {{ number_format($inscripcion->oferta->salario_min, 0, ',', '.') }}€
                            @if($inscripcion->oferta->salario_max)
                            - {{ number_format($inscripcion->oferta->salario_max, 0, ',', '.') }}€
                            @endif
                            @else
                            <span class="text-gray-400 italic">No definido</span>
                            @endif
                        </li>

                        {{-- ESTADO CORREGIDO --}}
                        <li><strong>Estado:</strong>
                            @php
                            $estado = $inscripcion->oferta->estado;
                            $color = $estado == 'publicada' ? 'text-green-600' : 'text-gray-500';
                            @endphp
                            <span class="{{ $color }} font-bold uppercase">{{ $estado }}</span>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <a href="{{ route('admin.ofertas.show', $inscripcion->oferta) }}" class="text-blue-600 text-sm hover:underline">
                            Ver oferta completa &rarr;
                        </a>
                    </div>
                    @else
                    <p class="text-red-600">Oferta eliminada</p>
                    @endif
                </div>

                {{-- EMPRESA --}}
                <div>
                    <h3 class="text-lg font-semibold text-indigo-700">Empresa</h3>
                    @if($inscripcion->oferta && $inscripcion->oferta->empresa)
                    <ul class="mt-2 space-y-1 text-sm">
                        <li><strong>Nombre:</strong> {{ $inscripcion->oferta->empresa->nombre }}</li>
                        <li><strong>Ciudad:</strong> {{ $inscripcion->oferta->empresa->ciudad }}</li>
                    </ul>
                    <div class="mt-3">
                        <a href="{{ route('admin.empresas.show', $inscripcion->oferta->empresa) }}" class="text-blue-600 text-sm hover:underline">
                            Ver ficha de la empresa &rarr;
                        </a>
                    </div>
                    @else
                    <p class="text-red-600">Empresa no disponible</p>
                    @endif
                </div>

                {{-- BOTONES --}}
                <div class="mt-8 pt-4 border-t">
                    <a href="{{ route('admin.inscripciones.index') }}"
                        class="px-6 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition font-bold">
                        Volver al listado
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>