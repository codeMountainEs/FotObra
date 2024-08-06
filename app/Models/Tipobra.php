<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipobra extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',

    ];

    public function obras(): HasMany
    {
        return $this->hasMany(Obra::class);
    }
}
