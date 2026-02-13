<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Oferta: {{ $oferta->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6 space-y-4">

                <h3 class="text-lg font-semibold">Datos de la oferta</h3>

                <ul class="space-y-2">
                    <li><strong>ID:</strong> {{ $oferta->id }}</li>
                    <li><strong>Título:</strong> {{ $oferta->titulo }}</li>
                    <li><strong>Descripción:</strong> {{ $oferta->descripcion }}</li>
                    <li><strong>Requisitos:</strong> {{ $oferta->requisitos }}</li>
                    <li><strong>Salario:</strong> {{ $oferta->salario }}</li>
                    <li><strong>Estado:</strong>
                        @if($oferta->estado)
                        <span class="text-green-600 font-semibold">Activa</span>
                        @else
                        <span class="text-red-600 font-semibold">Inactiva</span>
                        @endif
                    </li>
                    <li><strong>Fecha de publicación:</strong> {{ $oferta->created_at->format('d/m/Y') }}</li>
                </ul>

                <h3 class="text-lg font-semibold mt-6">Empresa</h3>
                <p>
                    <a href="{{ route('admin.empresas.show', $oferta->empresa) }}"
                        class="text-blue-600 hover:underline">
                        {{ $oferta->empresa->nombre }}
                    </a>
                </p>

                <div class="mt-6">
                    <a href="{{ route('admin.ofertas.update', $oferta) }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Editar oferta
                    </a>

                    <a href="{{ route('admin.ofertas.index') }}"
                        class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>