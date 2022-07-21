<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $fillable = ['nombre'];

    use HasFactory;

    /**
     * Consulta por tod@s l@s Comuna relacionad@s con est@ Distrito pasando a través de est@ Provincia.
     */
    public function comunas()
    {
        return $this->hasManyThrough(Comuna::class, Provincia::class);
    }

    /**
     * Consulta por tod@s l@s Provincia relacionad@s con est@ Distrito.
     */
    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }    
}
