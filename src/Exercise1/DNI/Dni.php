<?php

declare(strict_types=1);

namespace Exercise1\DNI;

use DomainException;
use LengthException;

class Dni
{
    private const VALID_LENGTH = 9;

    public function __construct(string $dni)
    {
        $this->checkDniHasValidLength($dni);
        if (preg_match('/[UIOÑ\d]$/u', $dni)) {
            throw new \DomainException('Ends with invalid letter');
        }
        if (!preg_match('/^[XYZ\d]\d{7,7}.$/', $dni)) {
            throw new \DomainException('Starts with invalid letter');
        }
        throw new \InvalidArgumentException('Invalid dni');

    }

    private function checkDniHasValidLength(string $dni): void
    {
        if (\strlen($dni) !== self::VALID_LENGTH) {
            throw new LengthException('Too long or too short');
        }
    }
}
