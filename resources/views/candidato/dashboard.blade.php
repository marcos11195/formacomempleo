<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del candidato
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ⭐ TARJETAS DEL MENÚ --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <a href="{{ route('candidato.edit') }}"
                        class="p-6 bg-gray-100 rounded-lg hover:bg-gray-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Editar perfil</h3>
                        <p class="text-gray-600 text-sm">
                            Modifica tus datos personales y tu información profesional.
                        </p>
                    </a>

                    <a href="{{ route('candidato.ofertas.index') }}"
                        class="p-6 bg-blue-100 rounded-lg hover:bg-blue-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Buscar ofertas</h3>
                        <p class="text-gray-600 text-sm">
                            Explora todas las ofertas disponibles.
                        </p>
                    </a>

                    <a href="{{ route('candidato.inscripciones') }}"
                        class="p-6 bg-green-100 rounded-lg hover:bg-green-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Mis inscripciones</h3>
                        <p class="text-gray-600 text-sm">
                            Consulta las ofertas en las que estás inscrito.
                        </p>
                    </a>

                </div>
            </div>

            {{-- ⭐ ESTADÍSTICAS DEL CANDIDATO --}}
            <div class="mt-10 bg-white shadow-xl sm:rounded-lg p-6">

                <h3 class="text-xl font-semibold mb-4">Tus estadísticas</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Inscripciones del candidato --}}
                    <div class="p-5 bg-purple-100 rounded-lg text-center">
                        <h4 class="text-2xl font-bold text-purple-700">
                            {{ auth()->user()->candidato->inscripciones()->count() }}
                        </h4>
                        <p class="text-gray-700 text-sm mt-1">Ofertas inscritas</p>
                    </div>

                    {{-- Total de ofertas publicadas --}}
                    <div class="p-5 bg-yellow-100 rounded-lg text-center">
                        <h4 class="text-2xl font-bold text-yellow-700">
                            {{ \App\Models\Oferta::count() }}
                        </h4>
                        <p class="text-gray-700 text-sm mt-1">Ofertas publicadas</p>
                    </div>

                    {{-- Ofertas activas (estado = 1 por ejemplo) --}}
                    <div class="p-5 bg-blue-100 rounded-lg text-center">
                        <h4 class="text-2xl font-bold text-blue-700">
                            {{ \App\Models\Oferta::where('estado', 1)->count() }}
                        </h4>
                        <p class="text-gray-700 text-sm mt-1">Ofertas activas</p>
                    </div>

                    {{-- Ofertas nuevas esta semana --}}
                    <div class="p-5 bg-green-100 rounded-lg text-center">
                        <h4 class="text-2xl font-bold text-green-700">
                            {{ \App\Models\Oferta::where('created_at', '>=', now()->subDays(7))->count() }}
                        </h4>
                        <p class="text-gray-700 text-sm mt-1">Nuevas esta semana</p>
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>