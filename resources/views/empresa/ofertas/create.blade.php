<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear nueva oferta
        </h2>
    </x-slot>

    <form method="POST"
        action="{{ route('ofertas.store') }}"
        class="max-w-5xl mx-auto space-y-10 py-10">
        @csrf

        {{-- TÍTULO --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Nueva oferta de empleo</h1>
            <p class="text-gray-600 mt-1">Completa los datos para publicar una oferta profesional.</p>
        </div>

        {{-- SECCIÓN 1: DATOS PRINCIPALES --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1">
                Datos principales
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <x-label for="titulo" value="Título de la oferta" />
                    <x-input id="titulo" name="titulo" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('titulo') }}"
                        required />
                </div>

                <div>
                    <x-label for="idpuesto" value="Puesto" />
                    <select id="idpuesto" name="idpuesto"
                        class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                        <option value="">Selecciona un puesto</option>
                        @foreach($puestos as $puesto)
                        <option value="{{ $puesto->id }}"
                            {{ old('idpuesto') == $puesto->id ? 'selected' : '' }}>
                            {{ $puesto->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <x-label for="descripcion" value="Descripción" />
                    <textarea id="descripcion" name="descripcion"
                        class="mt-1 block w-full border-gray-300 rounded-md"
                        rows="5"
                        required>{{ old('descripcion') }}</textarea>
                </div>

            </div>
        </div>

        {{-- SECCIÓN 2: REQUISITOS Y FUNCIONES --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1">
                Requisitos y funciones
            </h2>

            <div class="space-y-4">

                <div>
                    <x-label for="requisitos" value="Requisitos (opcional)" />
                    <textarea id="requisitos" name="requisitos"
                        class="mt-1 block w-full border-gray-300 rounded-md"
                        rows="4">{{ old('requisitos') }}</textarea>
                </div>

                <div>
                    <x-label for="funciones" value="Funciones (opcional)" />
                    <textarea id="funciones" name="funciones"
                        class="mt-1 block w-full border-gray-300 rounded-md"
                        rows="4">{{ old('funciones') }}</textarea>
                </div>

            </div>
        </div>

        {{-- SECCIÓN 3: DATOS PROFESIONALES --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1">
                Datos profesionales
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <x-label for="idsector" value="Sector" />
                    <select id="idsector" name="idsector"
                        class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                        <option value="">Selecciona un sector</option>
                        @foreach($sectores as $sector)
                        <option value="{{ $sector->id }}"
                            {{ old('idsector') == $sector->id ? 'selected' : '' }}>
                            {{ $sector->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-label for="idmodalidad" value="Modalidad" />
                    <select id="idmodalidad" name="idmodalidad"
                        class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                        <option value="">Selecciona modalidad</option>
                        @foreach($modalidades as $modalidad)
                        <option value="{{ $modalidad->id }}"
                            {{ old('idmodalidad') == $modalidad->id ? 'selected' : '' }}>
                            {{ $modalidad->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-label for="tipo_contrato" value="Tipo de contrato (opcional)" />
                    <x-input id="tipo_contrato" name="tipo_contrato" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('tipo_contrato') }}" />
                </div>

                <div>
                    <x-label for="jornada" value="Jornada (opcional)" />
                    <x-input id="jornada" name="jornada" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('jornada') }}" />
                </div>

                <div>
                    <x-label for="ubicacion" value="Ubicación (opcional)" />
                    <x-input id="ubicacion" name="ubicacion" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('ubicacion') }}" />
                </div>

            </div>
        </div>

        {{-- SECCIÓN 4: SALARIO --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1">
                Salario (opcional)
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <x-label for="salario_min" value="Salario mínimo" />
                    <x-input id="salario_min" name="salario_min" type="number" step="0.01"
                        class="mt-1 block w-full"
                        value="{{ old('salario_min') }}" />
                </div>

                <div>
                    <x-label for="salario_max" value="Salario máximo" />
                    <x-input id="salario_max" name="salario_max" type="number" step="0.01"
                        class="mt-1 block w-full"
                        value="{{ old('salario_max') }}" />
                </div>

            </div>
        </div>

        {{-- SECCIÓN 5: FECHAS --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1">
                Fechas
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <x-label for="publicar_hasta" value="Publicar hasta (opcional)" />
                    <x-input id="publicar_hasta" name="publicar_hasta" type="date"
                        class="mt-1 block w-full"
                        value="{{ old('publicar_hasta') }}" />
                </div>

                <div>
                    <x-label for="fecha_incorporacion" value="Fecha de incorporación (opcional)" />
                    <x-input id="fecha_incorporacion" name="fecha_incorporacion" type="date"
                        class="mt-1 block w-full"
                        value="{{ old('fecha_incorporacion') }}" />
                </div>

            </div>
        </div>

        {{-- SECCIÓN 6: ESTADO --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1">
                Estado de la oferta
            </h2>

            <select id="estado" name="estado"
                class="mt-1 block w-full border-gray-300 rounded-md"
                required>
                <option value="borrador" {{ old('estado') == 'borrador' ? 'selected' : '' }}>Borrador</option>
                <option value="publicada" {{ old('estado') == 'publicada' ? 'selected' : '' }}>Publicada</option>
                <option value="pausada" {{ old('estado') == 'pausada' ? 'selected' : '' }}>Pausada</option>
                <option value="cerrada" {{ old('estado') == 'cerrada' ? 'selected' : '' }}>Cerrada</option>
                <option value="vencida" {{ old('estado') == 'vencida' ? 'selected' : '' }}>Vencida</option>
            </select>
        </div>

        {{-- BOTÓN --}}
        <div class="flex justify-center">
            <x-button>
                Crear oferta
            </x-button>
        </div>

    </form>

</x-app-layout>