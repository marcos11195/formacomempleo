<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaSector extends Model
{
    protected $table = 'empresa_sector';

    public $timestamps = false;

    protected $fillable = [
        'idempresa',
        'idsector',
    ];
}
