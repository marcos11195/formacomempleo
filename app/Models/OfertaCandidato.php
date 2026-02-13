<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfertaCandidato extends Model
{
    protected $table = 'ofertas_candidatos';

    public $timestamps = false;

    protected $fillable = [
        'idoferta',
        'idcandidato',
        'fecha_inscripcion',
        'estado',
        'comentarios',
        'updated_at'
    ];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'idcandidato');
    }

    public function oferta()
    {
        return $this->belongsTo(Oferta::class, 'idoferta');
    }
}
