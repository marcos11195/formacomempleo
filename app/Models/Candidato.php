<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use SoftDeletes;

    protected $table = 'candidatos';

    protected $fillable = [
        'dni','nombre','apellidos','telefono','email','password_hash',
        'linkedin','web','cv','foto','direccion','cp','ciudad','provincia',
        'fecha_nacimiento'
    ];

    public function ofertas()
    {
        return $this->belongsToMany(Oferta::class, 'ofertas_candidatos', 'idcandidato', 'idoferta')
                    ->withPivot(['fecha_inscripcion','estado','comentarios'])
                    ->withTimestamps();
    }
    public function user()
{
    return $this->hasOne(User::class, 'candidato_id');
}

}
