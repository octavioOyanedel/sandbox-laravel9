<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $fillable = ['nombre', 'distrito_id'];

    use HasFactory;

    /**
     * Consulta por tod@s l@s Comuna relacionad@s con est@ Provincia.
     */
    public function comunas()
    {
        return $this->hasMany(Comuna::class);
    }

    /**
     * Consulta por es@ unic@ Distrito relacionad@ con est@ Provincia.
     */
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }    
}
