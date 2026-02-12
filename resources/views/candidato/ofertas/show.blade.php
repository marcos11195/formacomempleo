@if($inscrito)
<form method="POST" action="{{ route('candidato.desinscribirse', $oferta) }}">
    @csrf
    @method('DELETE')
    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
        Desinscribirse
    </button>
</form>
@else
<form method="POST" action="{{ route('candidato.inscribirse', $oferta) }}">
    @csrf
    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Inscribirme
    </button>
</form>
@endif