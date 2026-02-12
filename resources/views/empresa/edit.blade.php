<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar datos de la empresa
        </h2>
    </x-slot>

    <form method="POST"
        action="{{ route('empresa.update') }}"
        enctype="multipart/form-data"
        class="max-w-4xl mx-auto space-y-8 py-10">
        @csrf
        @method('PUT')

        {{-- TÍTULO --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Editar empresa</h1>
            <p class="text-gray-600 mt-1">Actualiza los datos de tu empresa.</p>
        </div>

        {{-- SECCIÓN 1: DATOS DE LA EMPRESA --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1 text-center">
                Datos de la empresa
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>
                    <x-label for="cif" value="CIF" />
                    <x-input id="cif" name="cif" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('cif', $empresa->cif) }}"
                        required />
                </div>

                <div>
                    <x-label for="nombre" value="Nombre de la empresa" />
                    <x-input id="nombre" name="nombre" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('nombre', $empresa->nombre) }}"
                        required />
                </div>

                <div>
                    <x-label for="telefono" value="Teléfono (opcional)" />
                    <x-input id="telefono" name="telefono" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('telefono', $empresa->telefono) }}" />
                </div>

                <div>
                    <x-label for="web" value="Página web (opcional)" />
                    <x-input id="web" name="web" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('web', $empresa->web) }}" />
                </div>

                <div>
                    <x-label for="persona_contacto" value="Persona de contacto (opcional)" />
                    <x-input id="persona_contacto" name="persona_contacto" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('persona_contacto', $empresa->persona_contacto) }}" />
                </div>

                <div>
                    <x-label for="email_contacto" value="Email de contacto" />
                    <x-input id="email_contacto" name="email_contacto" type="email"
                        class="mt-1 block w-full"
                        value="{{ old('email_contacto', $empresa->email_contacto) }}"
                        required />
                </div>

            </div>
        </div>

        {{-- SECCIÓN 2: DIRECCIÓN --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1 text-center">
                Dirección
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="sm:col-span-2">
                    <x-label for="direccion" value="Dirección (opcional)" />
                    <x-input id="direccion" name="direccion" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('direccion', $empresa->direccion) }}" />
                </div>

                <div>
                    <x-label for="cp" value="Código Postal (opcional)" />
                    <x-input id="cp" name="cp" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('cp', $empresa->cp) }}" />
                </div>

                <div>
                    <x-label for="ciudad" value="Ciudad (opcional)" />
                    <x-input id="ciudad" name="ciudad" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('ciudad', $empresa->ciudad) }}" />
                </div>

                <div>
                    <x-label for="provincia" value="Provincia (opcional)" />
                    <x-input id="provincia" name="provincia" type="text"
                        class="mt-1 block w-full"
                        value="{{ old('provincia', $empresa->provincia) }}" />
                </div>

            </div>
        </div>

        {{-- SECCIÓN 3: LOGO --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1 text-center">
                Logo de la empresa (opcional)
            </h2>

            <div class="grid grid-cols-1 gap-4">

                @if($empresa->logo)
                <div class="flex flex-col items-center">
                    <p class="text-gray-600 text-sm mb-2">Logo actual:</p>
                    <img src="{{ asset('storage/' . $empresa->logo) }}"
                        class="h-24 rounded shadow">
                </div>
                @endif

                <div>
                    <x-label for="logo" value="Subir nuevo logo" />
                    <input id="logo" name="logo" type="file"
                        class="mt-1 block w-full"
                        accept="image/*" />
                </div>

            </div>
        </div>

        {{-- BOTÓN --}}
        <div class="flex justify-center">
            <x-button>
                Guardar cambios
            </x-button>
        </div>

    </form>

</x-app-layout>