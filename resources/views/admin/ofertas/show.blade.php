<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Oferta: {{ $oferta->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6 space-y-4">

                <h3 class="text-lg font-semibold border-b pb-2">Datos de la oferta</h3>

                <ul class="space-y-3">
                    <li><strong>ID:</strong> {{ $oferta->id }}</li>
                    <li><strong>Título:</strong> {{ $oferta->titulo }}</li>
                    <li><strong>Descripción:</strong> {{ $oferta->descripcion }}</li>
                    <li><strong>Requisitos:</strong> {{ $oferta->requisitos }}</li>

                    <li><strong>Salario:</strong>
                        @if($oferta->salario_min)
                        {{ number_format($oferta->salario_min, 0, ',', '.') }}€
                        @if($oferta->salario_max)
                        - {{ number_format($oferta->salario_max, 0, ',', '.') }}€
                        @endif
                        @else
                        <span class="text-gray-400 italic">No definido</span>
                        @endif
                    </li>

                    <li><strong>Estado:</strong>
                        @php
                        $color = match($oferta->estado) {
                        'publicada' => 'text-green-600',
                        'borrador' => 'text-gray-500',
                        'pausada' => 'text-yellow-600',
                        'cerrada', 'vencida' => 'text-red-600',
                        default => 'text-gray-600'
                        };
                        @endphp
                        <span class="{{ $color }} font-bold uppercase text-sm">
                            {{ $oferta->estado }}
                        </span>
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

                <div class="mt-8 pt-4 border-t">
                    <a href="{{ route('admin.ofertas.edit', $oferta) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded font-bold hover:bg-blue-700 transition">
                        Editar oferta
                    </a>

                    <a href="{{ route('admin.ofertas.index') }}"
                        class="ml-3 inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 rounded font-bold hover:bg-gray-400 transition">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>