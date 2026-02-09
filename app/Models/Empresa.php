<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = 'empresas';

    protected $fillable = [
        'cif',
        'nombre',
        'telefono',
        'web',
        'persona_contacto',
        'email_contacto',
        'direccion',
        'cp',
        'ciudad',
        'provincia',
        'logo',
        'verificada',
    ];

    public function sectores()
    {
        return $this->belongsToMany(Sector::class, 'empresa_sector', 'idempresa', 'idsector');
    }
public function usuario()
{
    return $this->hasOne(User::class, 'empresa_id');
}

    }
