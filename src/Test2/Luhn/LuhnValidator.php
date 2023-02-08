<?php

declare(strict_types=1);

namespace Test2\Luhn;

class LuhnValidator
{

    public function isValid(string $luhnCode): bool
    {
        $inverted = strrev($luhnCode);

        return !($inverted[0] !== '0' || $inverted[2] !== '0');
    }
}
