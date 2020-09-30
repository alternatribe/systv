<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filme extends Programa
{
    use InheritanceLock;

    protected $table = 'programas';

    protected $hidden = ['type', 'created_at', 'updated_at'];

    public function tipo()
    {
        return 1;
    }
}
