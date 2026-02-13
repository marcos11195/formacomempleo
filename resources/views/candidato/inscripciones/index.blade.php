<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">Mis inscripciones</h2>
    </x-slot>

    {{-- ⭐ MODAL FLOTANTE --}}
    <div id="modalOferta" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh]">

            <button onclick="cerrarModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">
                ✕
            </button>

            <h2 id="modalTitulo" class="text-3xl font-bold mb-4"></h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <p><strong>Empresa:</strong> <span id="modalEmpresa"></span></p>
                <p><strong>Ubicación:</strong> <span id="modalUbicacion"></span></p>

                <p><strong>Modalidad:</strong> <span id="modalModalidad"></span></p>
                <p><strong>Sector:</strong> <span id="modalSector"></span></p>

                <p><strong>Puesto:</strong> <span id="modalPuesto"></span></p>
                <p><strong>Tipo de contrato:</strong> <span id="modalContrato"></span></p>

                <p><strong>Jornada:</strong> <span id="modalJornada"></span></p>
                <p><strong>Salario:</strong> <span id="modalSalario"></span></p>

                <p><strong>Fecha incorporación:</strong> <span id="modalIncorporacion"></span></p>
                <p><strong>Publicada el:</strong> <span id="modalPublicacion"></span></p>
            </div>

            <hr class="my-4">

            <h3 class="text-xl font-semibold mb-2">Descripción</h3>
            <p id="modalDescripcion" class="mb-4"></p>

            <h3 class="text-xl font-semibold mb-2">Requisitos</h3>
            <p id="modalRequisitos" class="mb-4"></p>

            <h3 class="text-xl font-semibold mb-2">Funciones</h3>
            <p id="modalFunciones" class="mb-4"></p>

            <div id="modalBoton" class="mt-6"></div>

        </div>
    </div>

    {{-- ⭐ CONTENIDO PRINCIPAL --}}
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white p-6 rounded shadow">

            @forelse($inscripciones as $oferta)
            <div class="border-b py-3 flex justify-between items-center">

                <span class="font-medium">{{ $oferta->titulo }}</span>

                <div class="flex gap-3">

                    {{-- ⭐ BOTÓN MODAL --}}
                    <button
                        onclick="abrirModal(this)"
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
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
                        data-funciones="{{ $oferta->funciones ?? 'No especificadas' }}">
                        Ver oferta
                    </button>

                    {{-- ⭐ DESCARGAR MI CV --}}
                    @if(auth()->user()->candidato->cv)
                    <a href="{{ asset('storage/' . auth()->user()->candidato->cv) }}"
                        target="_blank"
                        class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                        Mi CV
                    </a>
                    @endif

                    {{-- ⭐ DESINSCRIBIRSE --}}
                    <form method="POST" action="{{ route('candidato.desinscribirse', $oferta->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Desinscribirse
                        </button>
                    </form>

                </div>

            </div>
            @empty
            <p class="text-gray-500">No estás inscrito en ninguna oferta.</p>
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

            document.getElementById('modalBoton').innerHTML = `
                <form method="POST" action="/candidato/ofertas/${btn.dataset.id}/desinscribirse">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Desinscribirse
                    </button>
                </form>
            `;

            document.getElementById('modalOferta').classList.remove('hidden');
            document.getElementById('modalOferta').classList.add('flex');
        }

        function cerrarModal() {
            document.getElementById('modalOferta').classList.add('hidden');
            document.getElementById('modalOferta').classList.remove('flex');
        }
    </script>

</x-app-layout>