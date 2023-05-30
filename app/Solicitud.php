<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model {
    
    protected $table = "solicitudes";

    public function usuario() {
        return $this->belongsTo('App\User', 'idUsuario')->orderBy('name');
    }

    public function sector() {
        return $this->belongsTo('App\Sector', 'idSector')->orderBy('nombre');
    }

}
