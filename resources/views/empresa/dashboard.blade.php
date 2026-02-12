<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de empresa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- TARJETAS SUPERIORES --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <a href="{{ route('empresa.edit') }}"
                        class="p-6 bg-gray-100 rounded-lg hover:bg-gray-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Editar empresa</h3>
                        <p class="text-gray-600 text-sm">Modifica los datos de tu empresa.</p>
                    </a>

                    <a href="{{ route('ofertas.create') }}"
                        class="p-6 bg-blue-100 rounded-lg hover:bg-blue-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Crear oferta</h3>
                        <p class="text-gray-600 text-sm">Publica una nueva oferta de empleo.</p>
                    </a>

                    <a href="{{ route('ofertas.index') }}"
                        class="p-6 bg-green-100 rounded-lg hover:bg-green-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Mis ofertas</h3>
                        <p class="text-gray-600 text-sm">Gestiona, edita o elimina tus ofertas.</p>
                    </a>

                </div>
            </div>

            {{-- PANEL DE OFERTAS + ESTADÍSTICAS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                {{-- LISTA DE OFERTAS --}}
                <div class="md:col-span-1 bg-white p-4 rounded shadow">
                    <h3 class="font-semibold text-gray-700 mb-3">Ofertas creadas</h3>

                    {{-- BUSCADOR --}}
                    <form method="GET" action="{{ url('/empresa') }}" class="mb-4">
                        <input type="text"
                            name="search"
                            placeholder="Buscar oferta..."
                            value="{{ $search }}"
                            class="w-full border-gray-300 rounded px-3 py-2">
                    </form>

                    @forelse($ofertasEmpresa as $oferta)
                    <a href="{{ url('/empresa?oferta=' . $oferta->id) }}"
                        class="block p-3 mb-2 rounded border hover:bg-gray-100 transition">
                        <div class="font-medium">{{ $oferta->titulo }}</div>
                        <div class="text-sm text-gray-600">{{ ucfirst($oferta->estado) }}</div>
                    </a>
                    @empty
                    <p class="text-gray-500 text-sm">No tienes ofertas creadas.</p>
                    @endforelse
                </div>

                {{-- PANEL DE ESTADÍSTICAS --}}
                <div class="md:col-span-3 bg-white p-6 rounded shadow">

                    @if(!$ofertaSeleccionada)
                    <p class="text-gray-500">Selecciona una oferta de la lista para ver sus estadísticas.</p>
                    @else
                    <h1 class="text-2xl font-bold mb-4">{{ $ofertaSeleccionada->titulo }}</h1>

                    <p class="text-gray-700 mb-2">
                        <strong>Estado:</strong> {{ ucfirst($ofertaSeleccionada->estado) }}
                    </p>

                    <p class="text-gray-700 mb-2">
                        <strong>Inscritos:</strong> {{ $inscritos }}
                    </p>

                    <p class="text-gray-700 mb-4">
                        <strong>Descripción:</strong><br>
                        {{ $ofertaSeleccionada->descripcion }}
                    </p>

                    <a href="{{ route('ofertas.edit', $ofertaSeleccionada) }}"
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Editar oferta
                    </a>
                    @endif

                </div>

            </div>

        </div>
    </div>
</x-app-layout>