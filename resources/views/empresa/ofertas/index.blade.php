<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis ofertas
        </h2>
    </x-slot>

    <div class="flex justify-end mb-4">
        <form action="{{ route('ofertas.create') }}" method="GET">
            <button type="submit"
                class="inline-block px-5 py-2.5 rounded-md font-semibold shadow text-white bg-sky-600 hover:bg-sky-700 transition-colors">
                Crear nueva oferta
            </button>
        </form>
    </div>


    {{-- CONTENEDOR PRINCIPAL --}}
    <div class="bg-white shadow sm:rounded-lg p-6">

        @if($ofertas->isEmpty())
        <p class="text-gray-600 text-center py-6">
            Todavía no has creado ninguna oferta.
        </p>
        @else

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="py-3 px-2">Título</th>
                    <th class="py-3 px-2">Puesto</th>
                    <th class="py-3 px-2">Estado</th>
                    <th class="py-3 px-2">Publicación</th>
                    <th class="py-3 px-2 text-right">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($ofertas as $oferta)
                <tr class="border-b hover:bg-gray-50">

                    {{-- TÍTULO --}}
                    <td class="py-3 px-2 font-medium">
                        {{ $oferta->titulo }}
                    </td>

                    {{-- PUESTO --}}
                    <td class="py-3 px-2">
                        {{ $oferta->puesto->nombre ?? '—' }}
                    </td>

                    {{-- ESTADO CON COLOR --}}
                    <td class="py-3 px-2">
                        @php
                        $colores = [
                        'borrador' => 'bg-gray-300 text-gray-800',
                        'publicada' => 'bg-green-200 text-green-800',
                        'pausada' => 'bg-yellow-200 text-yellow-800',
                        'cerrada' => 'bg-red-200 text-red-800',
                        'vencida' => 'bg-orange-300 text-orange-900',
                        ];
                        @endphp

                        <span class="px-2 py-1 rounded text-sm {{ $colores[$oferta->estado] ?? 'bg-gray-200' }}">
                            {{ ucfirst($oferta->estado) }}
                        </span>
                    </td>

                    {{-- FECHA PUBLICACIÓN --}}
                    <td class="py-3 px-2">
                        {{ $oferta->fecha_publicacion ? $oferta->fecha_publicacion->format('d/m/Y') : '—' }}
                    </td>

                    {{-- ACCIONES --}}
                    <td class="py-3 px-2 text-right space-x-3">

                        {{-- EDITAR --}}
                        <a href="{{ route('ofertas.edit', $oferta) }}"
                            class="text-blue-600 hover:underline">
                            Editar
                        </a>

                        {{-- BORRAR --}}
                        <form action="{{ route('ofertas.destroy', $oferta) }}"
                            method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 hover:underline"
                                onclick="return confirm('¿Seguro que quieres eliminar esta oferta?')">
                                Eliminar
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        @endif

    </div>

    </div>

</x-app-layout>