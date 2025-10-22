<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <- importante para autenticación
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Maestro extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
    ];


    protected $hidden = [
        'contrasena',
        'remember_token',
    ];


    protected $casts = [
        'contrasena' => 'hashed', 
    ];


    public function clases()
    {
        return $this->hasMany(Clase::class, 'id_maestro');
    }
}
