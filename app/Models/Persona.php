<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public function documento(){
        return $this->belongsTo(Documento::class);
    }

    public function provedore(){
        return $this->hasOne(Provedore::class);
    }

    public function cliente(){
        return $this->hasOne(Cliente::class);
    }
}
