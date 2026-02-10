<x-app-layout>

    <form method="POST" action="{{ route('empresa.complete') }}" enctype="multipart/form-data" class="max-w-4xl mx-auto space-y-8">
        @csrf

        {{-- TÍTULO ARRIBA CENTRADO --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Completar perfil de empresa</h1>
            <p class="text-gray-600 mt-1">Introduce los datos de tu empresa para completar el registro.</p>
        </div>

        {{-- SECCIÓN 1: DATOS DE LA EMPRESA --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1 text-center">
                Datos de la empresa
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-label for="cif" value="CIF" />
                    <x-input id="cif" name="cif" type="text" class="mt-1 block w-full" required />
                </div>

                <div>
                    <x-label for="nombre" value="Nombre de la empresa" />
                    <x-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" required />
                </div>

                <div>
                    <x-label for="telefono" value="Teléfono" />
                    <x-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="web" value="Página web (opcional)" />
                    <x-input id="web" name="web" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="persona_contacto" value="Persona de contacto" />
                    <x-input id="persona_contacto" name="persona_contacto" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="email_contacto" value="Email de contacto" />
                    <x-input id="email_contacto" name="email_contacto" type="email" class="mt-1 block w-full" required />
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
                    <x-label for="direccion" value="Dirección" />
                    <x-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="cp" value="Código Postal" />
                    <x-input id="cp" name="cp" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="ciudad" value="Ciudad" />
                    <x-input id="ciudad" name="ciudad" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="provincia" value="Provincia" />
                    <x-input id="provincia" name="provincia" type="text" class="mt-1 block w-full" />
                </div>
            </div>
        </div>

        {{-- SECCIÓN 3: LOGO --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1 text-center">
                Logo de la empresa (opcional)
            </h2>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <x-label for="logo" value="Subir logo" />
                    <input id="logo" name="logo" type="file" class="mt-1 block w-full" accept="image/*" />
                </div>
            </div>
        </div>

        {{-- BOTÓN CENTRADO --}}
        <div class="flex justify-center">
            <x-button>
                Guardar y continuar
            </x-button>
        </div>

    </form>

</x-app-layout>
