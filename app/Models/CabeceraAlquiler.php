<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabeceraAlquiler extends Model
{
    use HasFactory;

    protected $table = 'cabecera_alquileres';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
