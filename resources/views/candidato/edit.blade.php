<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Editar perfil</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white p-6 rounded shadow">

            {{-- ⭐ FORMULARIO CORRECTO: POST REAL, SIN @method --}}
            <form method="POST" action="{{ route('candidato.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- ⭐ DATOS PERSONALES --}}
                <h3 class="text-lg font-semibold mb-4 border-b pb-1">Datos personales</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-1">Nombre</label>
                        <input type="text" name="nombre" value="{{ $candidato->nombre }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Apellidos</label>
                        <input type="text" name="apellidos" value="{{ $candidato->apellidos }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Email</label>
                        <input type="email" name="email" value="{{ $candidato->email }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">DNI</label>
                        <input type="text" name="dni" value="{{ $candidato->dni }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Teléfono</label>
                        <input type="text" name="telefono" value="{{ $candidato->telefono }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" value="{{ $candidato->fecha_nacimiento }}" class="w-full border rounded px-3 py-2">
                    </div>

                </div>

                {{-- ⭐ DIRECCIÓN --}}
                <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-1">Dirección</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="sm:col-span-2">
                        <label class="block mb-1">Dirección</label>
                        <input type="text" name="direccion" value="{{ $candidato->direccion }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Código Postal</label>
                        <input type="text" name="cp" value="{{ $candidato->cp }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Ciudad</label>
                        <input type="text" name="ciudad" value="{{ $candidato->ciudad }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Provincia</label>
                        <input type="text" name="provincia" value="{{ $candidato->provincia }}" class="w-full border rounded px-3 py-2">
                    </div>

                </div>

                {{-- ⭐ INFORMACIÓN ADICIONAL --}}
                <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-1">Información adicional</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-1">LinkedIn</label>
                        <input type="text" name="linkedin" value="{{ $candidato->linkedin }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Web personal</label>
                        <input type="text" name="web" value="{{ $candidato->web }}" class="w-full border rounded px-3 py-2">
                    </div>

                </div>

                {{-- ⭐ DESCRIPCIÓN --}}
                <div class="mt-6">
                    <label class="block mb-1">Descripción</label>
                    <textarea name="descripcion" class="w-full border rounded px-3 py-2" rows="4">{{ $candidato->descripcion }}</textarea>
                </div>

                {{-- ⭐ FOTO --}}
                <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-1">Foto</h3>

                <input type="file" name="foto" accept="image/*" class="w-full border rounded px-3 py-2 mb-4">

                @if($candidato->foto)
                <img src="{{ asset($candidato->foto) }}" class="w-24 h-24 rounded-full mb-4">
                @endif

                {{-- ⭐ CV --}}
                <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-1">Currículum</h3>

                <input type="file" name="cv" accept=".pdf,.doc,.docx" class="w-full border rounded px-3 py-2 mb-4">

                @if($candidato->cv)
                <p class="text-sm text-gray-600 mb-4">
                    CV actual:
                    <a href="{{ asset($candidato->cv) }}" target="_blank" class="text-blue-600 underline">
                        Descargar CV
                    </a>
                </p>
                @endif

                {{-- ⭐ BOTÓN --}}
                <div class="mt-6">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Guardar cambios
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>