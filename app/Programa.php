<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $fillable = [
        'nome',
        'nome_original',
        'ano'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function acompanhamento()
    {
        return $this->hasOne((Acompanhamento::class));
    }
}
