<x-app-layout>

    <form method="POST" action="{{ route('candidato.complete') }}" enctype="multipart/form-data" class="max-w-4xl mx-auto space-y-8">
        @csrf

        {{-- TÍTULO ARRIBA CENTRADO --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Completar perfil de candidato</h1>
            <p class="text-gray-600 mt-1">Rellena tus datos personales para completar tu registro.</p>
        </div>

        {{-- SECCIÓN 1: DATOS PERSONALES --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1 text-center">
                Datos personales
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-label for="nombre" value="Nombre" />
                    <x-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" required />
                </div>

                <div>
                    <x-label for="apellidos" value="Apellidos" />
                    <x-input id="apellidos" name="apellidos" type="text" class="mt-1 block w-full" required />
                </div>

                <div>
                    <x-label for="email" value="Email" />
                    <x-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                </div>

                <div>
                    <x-label for="dni" value="DNI" />
                    <x-input id="dni" name="dni" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="telefono" value="Teléfono" />
                    <x-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="fecha_nacimiento" value="Fecha de nacimiento" />
                    <x-input id="fecha_nacimiento" name="fecha_nacimiento" type="date" class="mt-1 block w-full" />
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

        {{-- SECCIÓN 3: INFORMACIÓN ADICIONAL --}}
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-1 text-center">
                Información adicional
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-label for="linkedin" value="LinkedIn (opcional)" />
                    <x-input id="linkedin" name="linkedin" type="text" class="mt-1 block w-full" />
                </div>

                <div>
                    <x-label for="web" value="Web personal (opcional)" />
                    <x-input id="web" name="web" type="text" class="mt-1 block w-full" />
                </div>

                {{-- FOTO (opcional) --}}
                <div>
                    <x-label for="foto" value="Foto (opcional)" />
                    <input id="foto" name="foto" type="file" class="mt-1 block w-full" accept="image/*" />
                </div>

                {{-- CV (opcional) --}}
                <div>
                    <x-label for="cv" value="CV (opcional)" />
                    <input id="cv" name="cv" type="file" class="mt-1 block w-full" accept=".pdf,.doc,.docx" />
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

