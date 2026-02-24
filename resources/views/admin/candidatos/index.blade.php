<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Candidatos registrados
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-hidden">

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-xs uppercase text-gray-500 tracking-wider">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Candidato</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Teléfono</th>
                            <th class="py-3 px-4 text-center">Ciudad</th>
                            <th class="py-3 px-4 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach($candidatos as $candidato)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-4 text-sm text-gray-400">#{{ $candidato->id }}</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    {{-- Miniatura de perfil --}}
                                    @if($candidato->foto)
                                    <img src="{{ asset($candidato->foto) }}" class="w-10 h-10 rounded-full mr-3 object-cover border shadow-sm">
                                    @else
                                    <div class="w-10 h-10 rounded-full mr-3 bg-indigo-100 flex items-center justify-center text-indigo-500 font-bold text-xs border border-indigo-200">
                                        {{ substr($candidato->nombre, 0, 1) }}{{ substr($candidato->apellidos, 0, 1) }}
                                    </div>
                                    @endif

                                    <div>
                                        <div class="font-medium text-gray-900">{{ $candidato->nombre }} {{ $candidato->apellidos }}</div>
                                        <div class="text-xs text-gray-400">{{ $candidato->dni }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-600">{{ $candidato->email }}</td>
                            <td class="py-4 px-4 text-sm text-gray-600">{{ $candidato->telefono }}</td>
                            <td class="py-4 px-4 text-sm text-gray-600 text-center">{{ $candidato->ciudad }}</td>

                            <td class="py-4 px-4 text-right">
                                <a href="{{ route('admin.candidatos.show', $candidato) }}"
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