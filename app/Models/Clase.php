<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_clase', 'id_maestro'
    ];

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_clase');
    }

    public function maestro()
    {
        return $this->belongsTo(Maestro::class, 'id_maestro');
    }
}
