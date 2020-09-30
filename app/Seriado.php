<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seriado extends Programa
{
    use InheritanceLock;

    protected $table = 'programas';

    public function tipo()
    {
        return 2;
    }

    protected $hidden = ['type', 'created_at', 'updated_at'];

}
