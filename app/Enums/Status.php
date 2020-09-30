<?php

namespace App\Enums;

use Rexlabs\Enum\Enum;

/**
 * The Status enum.
 *
 * @method static self ASSISTINDO()
 * @method static self ASSISTI()
 * @method static self QUERO()
 * @method static self DESISTI()
 */
class Status extends Enum
{
    const QUERO = "1";
    const ASSISTINDO = "2";
    const ASSISTI = "3";
    const DESISTI = "4";

    /**
     * Retrieve a map of enum keys and values.
     *
     * @return array
     */
    public static function map(): array
    {
        return [
            static::QUERO => 'Quero Assistir',
            static::ASSISTINDO => 'Estou Assistindo',
            static::ASSISTI => 'Já Assisti',
            static::DESISTI => 'Desisti de Assistir'
        ];
    }
}
