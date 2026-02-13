<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de administración
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-6">
                    Bienvenido, administrador
                </h3>

                {{-- ⭐ ACCESOS DIRECTOS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <a href="{{ route('admin.empresas.index') }}"
                        class="p-6 bg-blue-100 rounded-lg hover:bg-blue-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Empresas</h3>
                        <p class="text-gray-600 text-sm">Gestionar empresas registradas.</p>
                    </a>

                    <a href="{{ route('admin.ofertas.index') }}"
                        class="p-6 bg-green-100 rounded-lg hover:bg-green-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Ofertas</h3>
                        <p class="text-gray-600 text-sm">Ver y editar ofertas publicadas.</p>
                    </a>

                    <a href="{{ route('admin.candidatos.index') }}"
                        class="p-6 bg-purple-100 rounded-lg hover:bg-purple-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Candidatos</h3>
                        <p class="text-gray-600 text-sm">Ver perfiles de candidatos.</p>
                    </a>

                    <a href="{{ route('admin.inscripciones.index') }}"
                        class="p-6 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition block">
                        <h3 class="text-lg font-semibold mb-2">Inscripciones</h3>
                        <p class="text-gray-600 text-sm">Candidatos inscritos en ofertas.</p>
                    </a>

                </div>

                {{-- ⭐ ESTADÍSTICAS --}}
                <div class="mt-10">
                    <h3 class="text-lg font-semibold mb-4">Estadísticas generales</h3>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                        <div class="p-5 bg-blue-50 rounded-lg text-center">
                            <h4 class="text-2xl font-bold text-blue-700">{{ $numUsers }}</h4>
                            <p class="text-gray-700 text-sm mt-1">Usuarios</p>
                        </div>

                        <div class="p-5 bg-green-50 rounded-lg text-center">
                            <h4 class="text-2xl font-bold text-green-700">{{ $numEmpresas }}</h4>
                            <p class="text-gray-700 text-sm mt-1">Empresas</p>
                        </div>

                        <div class="p-5 bg-purple-50 rounded-lg text-center">
                            <h4 class="text-2xl font-bold text-purple-700">{{ $numCandidatos }}</h4>
                            <p class="text-gray-700 text-sm mt-1">Candidatos</p>
                        </div>

                        <div class="p-5 bg-yellow-50 rounded-lg text-center">
                            <h4 class="text-2xl font-bold text-yellow-700">{{ $numOfertas }}</h4>
                            <p class="text-gray-700 text-sm mt-1">Ofertas activas</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>