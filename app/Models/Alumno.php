<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 'nombre', 'correo', 'fecha_nacimiento', 'sexo', 'carrera'
    ];

    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'alumno_clase');
    }
}
