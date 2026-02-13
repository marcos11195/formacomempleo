<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ofertas publicadas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">ID</th>
                            <th>Título</th>
                            <th>Empresa</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ofertas as $oferta)
                        <tr class="border-b">
                            <td class="py-2">{{ $oferta->id }}</td>
                            <td>{{ $oferta->titulo }}</td>
                            <td>{{ $oferta->empresa->nombre }}</td>
                            <td>
                                @if($oferta->estado)
                                <span class="text-green-600 font-semibold">Activa</span>
                                @else
                                <span class="text-red-600 font-semibold">Inactiva</span>
                                @endif
                            </td>
                            <td>{{ $oferta->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.ofertas.show', $oferta) }}"
                                    class="text-blue-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>