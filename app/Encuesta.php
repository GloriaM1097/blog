<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    //
    protected $table='encuesta';
    protected $fillable =[        
        'respuesta',
        'idempresa',
        'idsolicitud',
    ];
}
