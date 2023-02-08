<?php

declare(strict_types=1);

namespace Test2\Luhn;

class LuhnValidator
{

    public function isValid(string $luhnCode): bool
    {
        $inverted = strrev($luhnCode);
        if ($inverted[0] !== '0') {
            return false;
        }


        return true;
    }
}
