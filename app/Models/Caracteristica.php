<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function categoria()
    {
        return $this->hasMany(Categoria::class);
    }

    public function marca()
    {
        return $this->hasMany(Marca::class);
    }

    public function presentacione()
    {
        return $this->hasMany(Presentacione::class);
    }
}
