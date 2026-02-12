<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oferta extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'idempresa',
        'idsector',
        'idmodalidad',
        'idpuesto',
        'titulo',
        'descripcion',
        'requisitos',
        'funciones',
        'salario_min',
        'salario_max',
        'tipo_contrato',
        'jornada',
        'ubicacion',
        'fecha_publicacion',
        'publicar_hasta',
        'fecha_incorporacion',
        'estado',
    ];

    protected $casts = [
        'fecha_publicacion' => 'datetime',
        'publicar_hasta' => 'datetime',
        'fecha_incorporacion' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($oferta) {
            if (empty($oferta->fecha_publicacion)) {
                $oferta->fecha_publicacion = now();
            }
        });
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idempresa');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'idsector');
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'idmodalidad');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'idpuesto');
    }

    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, 'ofertas_candidatos', 'idoferta', 'idcandidato')
            ->withPivot(['estado', 'comentarios', 'fecha_inscripcion']);
    }

    public function inscripciones()
    {
        return $this->belongsToMany(Candidato::class, 'ofertas_candidatos', 'idoferta', 'idcandidato')
            ->withPivot(['fecha_inscripcion', 'estado', 'comentarios']);
    }
}
