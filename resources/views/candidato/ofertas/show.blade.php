<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de ofertas de la empresa
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 grid grid-cols-1 md:grid-cols-4 gap-6">

        {{-- LISTA DE OFERTAS --}}
        <div class="md:col-span-1 space-y-2">
            <h3 class="font-semibold text-gray-700 mb-2">Mis ofertas</h3>

            @foreach($ofertasEmpresa as $o)
            <a href="{{ route('empresa.ofertas.show', $o) }}"
                class="block p-3 rounded border 
                    {{ $o->id === $oferta->id ? 'bg-blue-100 border-blue-400' : 'bg-white border-gray-300' }}">
                <div class="font-medium">{{ $o->titulo }}</div>
                <div class="text-sm text-gray-600">
                    {{ ucfirst($o->estado) }}
                </div>
            </a>
            @endforeach
        </div>

        {{-- PANEL PRINCIPAL --}}
        <div class="md:col-span-3 bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-4">{{ $oferta->titulo }}</h1>

            <p class="text-gray-700 mb-4">
                <strong>Estado:</strong> {{ ucfirst($oferta->estado) }}
            </p>

            <p class="text-gray-700 mb-4">
                <strong>Inscritos:</strong> {{ $inscritos }}
            </p>

            <p class="text-gray-700 mb-4">
                <strong>Descripción:</strong><br>
                {{ $oferta->descripcion }}
            </p>

            <a href="{{ route('ofertas.edit', $oferta) }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Editar oferta
            </a>

            {{-- LISTADO DE CANDIDATOS INSCRITOS --}}
            <h2 class="text-xl font-semibold mt-8 mb-4">Candidatos inscritos</h2>

            @if($oferta->inscripciones->count() > 0)
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Nombre</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">CV</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($oferta->inscripciones as $candidato)
                    <tr>
                        <td class="p-2 border">{{ $candidato->nombre }} {{ $candidato->apellidos }}</td>
                        <td class="p-2 border">{{ $candidato->email }}</td>
                        <td class="p-2 border text-center">
                            @if($candidato->cv)
                            <a href="{{ asset('storage/' . $candidato->cv) }}"
                                target="_blank"
                                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                Descargar CV
                            </a>
                            @else
                            <span class="text-gray-500">Sin CV</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-gray-500">No hay candidatos inscritos todavía.</p>
            @endif

        </div>

    </div>

</x-app-layout>