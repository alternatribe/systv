<?php

namespace App;

use App\Scopes\InheritanceLockScope;

trait InheritanceLock
{
    public static function bootInheritanceLock(): void
    {
        $typeSetting = function ($model) {
            $model->type = parent::tipo();
        };

        static::creating($typeSetting);
        static::saving($typeSetting);
        static::addGlobalScope(
            new InheritanceLockScope(parent::tipo())
        );
    }
}
