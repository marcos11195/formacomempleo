<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inscripciones de candidatos en ofertas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Oferta</th>
                            <th>Candidato</th>
                            <th>Empresa</th>
                            <th>Fecha inscripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($inscripciones as $inscripcion)
                        <tr class="border-b">

                            {{-- OFERTA --}}
                            <td>
                                @if($inscripcion->oferta)
                                <a href="{{ route('admin.ofertas.show', $inscripcion->oferta) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $inscripcion->oferta->titulo }}
                                </a>
                                @else
                                <span class="text-red-600">Oferta eliminada</span>
                                @endif
                            </td>

                            {{-- CANDIDATO --}}
                            <td>
                                @if($inscripcion->candidato)
                                <a href="{{ route('admin.candidatos.show', $inscripcion->candidato) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $inscripcion->candidato->nombre }} {{ $inscripcion->candidato->apellidos }}
                                </a>
                                @else
                                <span class="text-red-600">Candidato eliminado</span>
                                @endif
                            </td>

                            {{-- EMPRESA --}}
                            <td>
                                @if($inscripcion->oferta && $inscripcion->oferta->empresa)
                                <a href="{{ route('admin.empresas.show', $inscripcion->oferta->empresa) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $inscripcion->oferta->empresa->nombre }}
                                </a>
                                @else
                                <span class="text-red-600">Empresa no disponible</span>
                                @endif
                            </td>

                            {{-- FECHA --}}
                            <td>{{ $inscripcion->fecha_inscripcion }}</td>

                            {{-- ACCIONES --}}
                            <td>
                                <a href="{{ route('admin.inscripciones.show', [$inscripcion->idoferta, $inscripcion->idcandidato]) }}"
                                    class="text-blue-600 hover:underline">
                                    Ver
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>