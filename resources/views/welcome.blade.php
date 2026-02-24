<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 text-gray-900 font-sans">
    <div class="relative min-h-screen flex flex-col">

        <header class="w-full max-w-7xl mx-auto px-6 py-8 flex justify-between items-center">
            <div class="transform scale-125 origin-left">
                <x-authentication-card-logo />
            </div>

            <nav>
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-800 border border-transparent rounded-lg font-semibold text-sm text-white shadow-sm hover:bg-gray-700 transition">
                    Log in
                </a>
                @endauth
                @endif
            </nav>
        </header>

        <main class="flex-grow flex flex-col items-center justify-center px-6 py-12">

            <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                @forelse($ofertas as $oferta)
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="flex justify-between items-start">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-1 rounded">
                                {{ $oferta->sector->nombre ?? 'General' }}
                            </span>
                            <span class="text-xs text-gray-400">
                                {{ $oferta->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h3 class="mt-3 font-bold text-lg text-gray-800 line-clamp-1">
                            {{ $oferta->titulo }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $oferta->empresa->nombre_comercial ?? 'Empresa Registrada' }}
                        </p>

                        <p class="text-xs text-gray-400 mt-2">
                            📍 {{ $oferta->ubicacion ?? 'Ubicación a consultar' }}
                        </p>
                    </div>

                    <div class="mt-6 flex justify-between items-center border-t border-gray-50 pt-4">
                        <div class="text-sm font-semibold text-gray-700">
                            @if($oferta->salario_min)
                            {{ number_format($oferta->salario_min, 0, ',', '.') }}€
                            @else
                            S/D
                            @endif
                        </div>
                        <a href="{{ route('login') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 uppercase tracking-tighter transition">
                            Postularse →
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12 bg-white rounded-2xl border-2 border-dashed border-gray-100">
                    <p class="text-gray-400 font-medium italic">No hay ofertas disponibles todavía.</p>
                </div>
                @endforelse
            </div>

            <div class="max-w-3xl text-center">
                <h1 class="text-5xl font-extrabold text-gray-900 mb-6 tracking-tight uppercase">
                    Portal de Empleo
                </h1>

                <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-xl mx-auto">
                    Encuentra las mejores ofertas de trabajo o publica tus vacantes para encontrar el talento ideal.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register.candidato') }}" class="w-full sm:w-auto inline-flex items-center px-8 py-4 bg-gray-900 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-[0.2em] hover:bg-gray-800 shadow-xl transition active:scale-95">
                        Registrarme como candidato
                    </a>

                    <a href="{{ route('register.empresa') }}" class="w-full sm:w-auto inline-flex items-center px-8 py-4 bg-white border-2 border-gray-200 rounded-xl font-bold text-xs text-gray-700 uppercase tracking-[0.1em] hover:bg-gray-50 shadow-sm transition active:scale-95">
                        Registrar empresa
                    </a>
                </div>
            </div>
        </main>

        <footer class="w-full py-8 text-center text-xs text-gray-400 border-t border-gray-100 bg-white/30">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}.</p>
        </footer>
    </div>
</body>

</html>