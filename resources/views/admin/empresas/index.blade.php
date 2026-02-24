<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Empresas registradas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-xs uppercase text-gray-500 tracking-wider">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Empresa</th>
                            <th class="py-3 px-4">Contacto</th>
                            <th class="py-3 px-4">CIF</th>
                            <th class="py-3 px-4">Ciudad</th>
                            <th class="py-3 px-4 text-center">Estado</th>
                            <th class="py-3 px-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($empresas as $empresa)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-4 text-sm text-gray-400">#{{ $empresa->id }}</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    @if($empresa->logo)
                                    <img src="{{ asset($empresa->logo) }}" class="w-8 h-8 rounded-full mr-3 object-cover border">
                                    @endif
                                    <div class="font-medium text-gray-900">{{ $empresa->nombre }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm">
                                <div class="text-gray-700 font-medium">{{ $empresa->persona_contacto }}</div>
                                <div class="text-gray-400 text-xs">{{ $empresa->email_contacto }}</div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-600">{{ $empresa->cif }}</td>
                            <td class="py-4 px-4 text-sm text-gray-600">{{ $empresa->ciudad }}</td>
                            <td class="py-4 px-4 text-center">
                                @if($empresa->verificada)
                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Verificada</span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Pendiente</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right">
                                <a href="{{ route('admin.empresas.show', $empresa) }}"
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