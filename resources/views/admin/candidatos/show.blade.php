<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Candidato: {{ $candidato->nombre }} {{ $candidato->apellidos }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6 space-y-8">

                {{-- CABECERA / FOTO --}}
                <div class="flex items-center space-x-6">
                    @if($candidato->foto)
                    <img src="{{ asset($candidato->foto) }}" alt="Foto del candidato"
                        class="w-32 h-32 rounded-full object-cover border-4 border-indigo-50 shadow-sm">
                    @else
                    <div class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 border text-4xl font-bold">
                        {{ substr($candidato->nombre, 0, 1) }}{{ substr($candidato->apellidos, 0, 1) }}
                    </div>
                    @endif
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $candidato->nombre }} {{ $candidato->apellidos }}</h3>
                        <p class="text-gray-500">{{ $candidato->email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- DATOS PERSONALES --}}
                    <section>
                        <h4 class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-4 border-b pb-1">Datos personales</h4>
                        <ul class="space-y-3 text-sm">
                            <li><strong>ID:</strong> <span class="text-gray-600">#{{ $candidato->id }}</span></li>
                            <li><strong>DNI:</strong> <span class="text-gray-600">{{ $candidato->dni }}</span></li>
                            <li><strong>Teléfono:</strong> <span class="text-gray-600">{{ $candidato->telefono }}</span></li>
                            <li><strong>Fecha nacimiento:</strong> <span class="text-gray-600">
                                    {{ $candidato->fecha_nacimiento ? \Carbon\Carbon::parse($candidato->fecha_nacimiento)->format('d/m/Y') : 'No indicada' }}
                                </span></li>
                        </ul>
                    </section>

                    {{-- DIRECCIÓN --}}
                    <section>
                        <h4 class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-4 border-b pb-1">Ubicación</h4>
                        <ul class="space-y-3 text-sm">
                            <li><strong>Dirección:</strong> <span class="text-gray-600">{{ $candidato->direccion }}</span></li>
                            <li><strong>Ciudad:</strong> <span class="text-gray-600">{{ $candidato->ciudad }} ({{ $candidato->cp }})</span></li>
                            <li><strong>Provincia:</strong> <span class="text-gray-600">{{ $candidato->provincia }}</span></li>
                        </ul>
                    </section>

                    {{-- INFO EXTRA --}}
                    <section>
                        <h4 class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-4 border-b pb-1">Presencia Digital</h4>
                        <ul class="space-y-3 text-sm">
                            <li><strong>LinkedIn:</strong>
                                @if($candidato->linkedin)
                                <a href="{{ $candidato->linkedin }}" target="_blank" class="text-blue-600 hover:underline">Ver perfil</a>
                                @else <span class="text-gray-400 italic">No indicado</span> @endif
                            </li>
                            <li><strong>Web:</strong>
                                @if($candidato->web)
                                <a href="{{ $candidato->web }}" target="_blank" class="text-blue-600 hover:underline">Visitar web</a>
                                @else <span class="text-gray-400 italic">No indicada</span> @endif
                            </li>
                        </ul>
                    </section>

                    {{-- CV --}}
                    <section>
                        <h4 class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-4 border-b pb-1">Currículum Vitae</h4>
                        @if($candidato->cv)
                        <a href="{{ asset($candidato->cv) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-xs font-bold rounded shadow-sm hover:bg-green-700 transition uppercase">
                            Descargar PDF
                        </a>
                        @else
                        <p class="text-sm text-gray-400 italic">No hay archivo adjunto.</p>
                        @endif
                    </section>
                </div>

                {{-- BOTONES --}}
                <div class="mt-10 pt-6 border-t flex space-x-3">
                    <a href="{{ route('admin.candidatos.edit', $candidato) }}"
                        class="px-6 py-2 bg-blue-600 text-white font-bold rounded hover:bg-blue-700 transition shadow-sm text-xs uppercase">
                        Editar candidato
                    </a>

                    <a href="{{ route('admin.candidatos.index') }}"
                        class="px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded hover:bg-gray-300 transition text-xs uppercase">
                        Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>