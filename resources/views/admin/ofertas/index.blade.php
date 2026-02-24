<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ofertas publicadas (Panel Admin)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-hidden">

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-xs uppercase text-gray-500 tracking-wider">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Título</th>
                            <th class="py-3 px-4">Empresa</th>
                            <th class="py-3 px-4">Salario</th>
                            <th class="py-3 px-4 text-center">Estado</th>
                            <th class="py-3 px-4">Fecha</th>
                            <th class="py-3 px-4 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach($ofertas as $oferta)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-4 text-sm text-gray-400">#{{ $oferta->id }}</td>
                            <td class="py-4 px-4 font-medium text-gray-900">{{ $oferta->titulo }}</td>
                            <td class="py-4 px-4 text-sm text-gray-600">{{ $oferta->empresa->nombre }}</td>

                            <td class="py-4 px-4 text-sm font-semibold text-gray-700">
                                @if($oferta->salario_min)
                                {{ number_format($oferta->salario_min, 0, ',', '.') }}€
                                @if($oferta->salario_max)
                                - {{ number_format($oferta->salario_max, 0, ',', '.') }}€
                                @endif
                                @else
                                <span class="text-gray-400 italic font-normal">No indicado</span>
                                @endif
                            </td>

                            <td class="py-4 px-4 text-center">
                                @php
                                $color = match($oferta->estado) {
                                'publicada' => 'bg-green-100 text-green-700',
                                'borrador' => 'bg-gray-100 text-gray-600',
                                'pausada' => 'bg-yellow-100 text-yellow-700',
                                'cerrada', 'vencida' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-600'
                                };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase {{ $color }}">
                                    {{ $oferta->estado }}
                                </span>
                            </td>

                            <td class="py-4 px-4 text-sm text-gray-500">
                                {{ $oferta->created_at->format('d/m/Y') }}
                            </td>

                            <td class="py-4 px-4 text-right">
                                <a href="{{ route('admin.ofertas.show', $oferta) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition text-sm font-bold uppercase tracking-tighter">
                                    Ver Detalles
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