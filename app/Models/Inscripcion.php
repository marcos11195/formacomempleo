<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'candidato_id',
        'oferta_id',
    ];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }

    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }
}
