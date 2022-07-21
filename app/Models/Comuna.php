<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $fillable = ['nombre', 'distrito_id', 'provincia_id'];

    use HasFactory;

    /**
     * Consulta por es@ unic@ Distrito relacionad@ con est@ Comuna.
     */
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

    /**
     * Consulta por es@ unic@ Provincia relacionad@ con est@ Comuna.
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }    
}
