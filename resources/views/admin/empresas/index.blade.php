<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Empresas registradas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>CIF</th>
                            <th>Ciudad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($empresas as $empresa)
                        <tr class="border-b">
                            <td class="py-2">{{ $empresa->id }}</td>
                            <td>{{ $empresa->nombre }}</td>

                            {{-- EMAIL CORRECTO --}}
                            <td>{{ $empresa->email_contacto }}</td>

                            <td>{{ $empresa->telefono }}</td>
                            <td>{{ $empresa->cif }}</td>
                            <td>{{ $empresa->ciudad }}</td>
                            <td>
                                <a href="{{ route('admin.empresas.show', $empresa) }}"
                                    class="text-blue-600 hover:underline">
                                    Ver
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