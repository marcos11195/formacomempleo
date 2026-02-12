<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buscar ofertas
        </h2>
    </x-slot>

    {{-- ⭐ MODAL FLOTANTE (SIEMPRE FUERA DEL CONTENIDO PRINCIPAL) --}}
    <div id="modalOferta" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh]">

            {{-- Botón cerrar --}}
            <button onclick="cerrarModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">
                ✕
            </button>

            {{-- Título --}}
            <h2 id="modalTitulo" class="text-3xl font-bold mb-4"></h2>

            {{-- Información básica --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                <p class="text-gray-700"><strong>Empresa:</strong> <span id="modalEmpresa"></span></p>
                <p class="text-gray-700"><strong>Ubicación:</strong> <span id="modalUbicacion"></span></p>

                <p class="text-gray-700"><strong>Modalidad:</strong> <span id="modalModalidad"></span></p>
                <p class="text-gray-700"><strong>Sector:</strong> <span id="modalSector"></span></p>

                <p class="text-gray-700"><strong>Puesto:</strong> <span id="modalPuesto"></span></p>
                <p class="text-gray-700"><strong>Tipo de contrato:</strong> <span id="modalContrato"></span></p>

                <p class="text-gray-700"><strong>Jornada:</strong> <span id="modalJornada"></span></p>
                <p class="text-gray-700"><strong>Salario:</strong> <span id="modalSalario"></span></p>

                <p class="text-gray-700"><strong>Fecha incorporación:</strong> <span id="modalIncorporacion"></span></p>
                <p class="text-gray-700"><strong>Publicada el:</strong> <span id="modalPublicacion"></span></p>

            </div>

            <hr class="my-4">

            {{-- Descripción --}}
            <h3 class="text-xl font-semibold mb-2">Descripción</h3>
            <p id="modalDescripcion" class="text-gray-700 mb-4"></p>

            {{-- Requisitos --}}
            <h3 class="text-xl font-semibold mb-2">Requisitos</h3>
            <p id="modalRequisitos" class="text-gray-700 mb-4"></p>

            {{-- Funciones --}}
            <h3 class="text-xl font-semibold mb-2">Funciones</h3>
            <p id="modalFunciones" class="text-gray-700 mb-4"></p>

            {{-- Botón dinámico --}}
            <div id="modalBoton" class="mt-6"></div>

        </div>
    </div>


    {{-- ⭐ CONTENIDO PRINCIPAL --}}
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        {{-- ⭐ FORMULARIO DE BÚSQUEDA --}}
        <form method="GET" action="{{ route('candidato.ofertas.index') }}" class="mb-6">
            <input type="text"
                name="search"
                placeholder="Buscar ofertas..."
                value="{{ $search }}"
                class="w-full border-gray-300 rounded px-3 py-2">
        </form>

        {{-- ⭐ LISTADO DE OFERTAS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($ofertas as $oferta)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">

                <h3 class="text-xl font-semibold mb-2">{{ $oferta->titulo }}</h3>

                <p class="text-gray-600 text-sm mb-1">
                    <strong>Empresa:</strong> {{ $oferta->empresa->nombre ?? 'Empresa desconocida' }}
                </p>

                <p class="text-gray-600 text-sm mb-1">
                    <strong>Ubicación:</strong> {{ $oferta->ubicacion ?? 'No especificada' }}
                </p>

                <p class="text-gray-600 text-sm mb-4">
                    <strong>Modalidad:</strong> {{ $oferta->modalidad->nombre ?? 'No especificada' }}
                </p>

                <p class="text-gray-700 text-sm mb-4">
                    {{ Str::limit($oferta->descripcion, 120) }}
                </p>

                {{-- ⭐ BOTÓN QUE ABRE EL MODAL --}}
                <button
                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    onclick="abrirModal(this)"
                    data-id="{{ $oferta->id }}"
                    data-titulo="{{ $oferta->titulo }}"
                    data-empresa="{{ $oferta->empresa->nombre }}"
                    data-ubicacion="{{ $oferta->ubicacion ?? 'No especificada' }}"
                    data-modalidad="{{ $oferta->modalidad->nombre ?? 'No especificada' }}"
                    data-sector="{{ $oferta->sector->nombre ?? 'No especificado' }}"
                    data-puesto="{{ $oferta->puesto->nombre ?? 'No especificado' }}"
                    data-contrato="{{ $oferta->tipo_contrato ?? 'No especificado' }}"
                    data-jornada="{{ $oferta->jornada ?? 'No especificificada' }}"
                    data-salario="{{ ($oferta->salario_min && $oferta->salario_max) ? $oferta->salario_min . ' - ' . $oferta->salario_max . ' €' : 'No especificado' }}"
                    data-incorporacion="{{ optional($oferta->fecha_incorporacion)->format('d/m/Y') ?? 'No especificada' }}"
                    data-publicacion="{{ optional($oferta->fecha_publicacion)->format('d/m/Y') ?? 'No especificada' }}"
                    data-descripcion="{{ $oferta->descripcion }}"
                    data-requisitos="{{ $oferta->requisitos ?? 'No especificados' }}"
                    data-funciones="{{ $oferta->funciones ?? 'No especificadas' }}"
                    data-inscrito="{{ $oferta->inscripciones()->where('idcandidato', auth()->user()->candidato->id)->exists() ? '1' : '0' }}">
                    Ver oferta
                </button>

            </div>

            @empty
            <p class="text-gray-500">No se encontraron ofertas.</p>
            @endforelse

        </div>

    </div>

    {{-- ⭐ SCRIPT DEL MODAL --}}
    <script>
        function abrirModal(btn) {

            document.getElementById('modalTitulo').innerText = btn.dataset.titulo;
            document.getElementById('modalEmpresa').innerText = btn.dataset.empresa;
            document.getElementById('modalUbicacion').innerText = btn.dataset.ubicacion;
            document.getElementById('modalModalidad').innerText = btn.dataset.modalidad;

            document.getElementById('modalSector').innerText = btn.dataset.sector;
            document.getElementById('modalPuesto').innerText = btn.dataset.puesto;
            document.getElementById('modalContrato').innerText = btn.dataset.contrato;
            document.getElementById('modalJornada').innerText = btn.dataset.jornada;
            document.getElementById('modalSalario').innerText = btn.dataset.salario;
            document.getElementById('modalIncorporacion').innerText = btn.dataset.incorporacion;
            document.getElementById('modalPublicacion').innerText = btn.dataset.publicacion;

            document.getElementById('modalDescripcion').innerText = btn.dataset.descripcion;
            document.getElementById('modalRequisitos').innerText = btn.dataset.requisitos;
            document.getElementById('modalFunciones').innerText = btn.dataset.funciones;

            let inscrito = btn.dataset.inscrito === "1";

            let boton = inscrito ?
                `
                <form method="POST" action="/candidato/ofertas/${btn.dataset.id}/desinscribirse">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Desinscribirse
                    </button>
                </form>
            ` :
                `
                <form method="POST" action="/candidato/ofertas/${btn.dataset.id}/inscribirse">
                    @csrf
                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Inscribirme
                    </button>
                </form>
            `;

            document.getElementById('modalBoton').innerHTML = boton;

            document.getElementById('modalOferta').classList.remove('hidden');
            document.getElementById('modalOferta').classList.add('flex');
        }

        function cerrarModal() {
            document.getElementById('modalOferta').classList.add('hidden');
            document.getElementById('modalOferta').classList.remove('flex');
        }
    </script>

</x-app-layout>