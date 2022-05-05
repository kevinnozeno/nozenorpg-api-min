<?php

namespace App\Http\Helpers;

use App\Models\UserCharacter;

class UserCharacterHelper
{
    public static function actualPvValidation ($actualPv, $pvMax): int
    {
        if (isset($actualPv)) {
            $actualPv = $actualPv > $pvMax ? $pvMax : $actualPv;
            $actualPv = $actualPv < 0 ? 0 : $actualPv;
        }
        else {
            $actualPv = $pvMax;
        }
        return $actualPv;
    }
}
