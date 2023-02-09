<?php

declare(strict_types=1);

namespace Test2\Luhn;

class LuhnValidator
{

    public function isValid(string $luhnCode): bool
    {
        $inverted = strrev($luhnCode);

        $oddAdded = $this->addOddDigits($inverted);

        return $oddAdded % 10 === 0;
    }

    private function addOddDigits(string $inverted): int
    {
        return $inverted[0]
            + $inverted[2]
            + $inverted[4]
            + $inverted[6]
            + $inverted[8]
            + $inverted[10];
    }
}
