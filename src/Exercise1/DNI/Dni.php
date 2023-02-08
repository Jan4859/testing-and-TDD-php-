<?php

declare(strict_types=1);

namespace Exercise1\DNI;

use DomainException;
use InvalidArgumentException;

class Dni
{
    private const VALID_DNI_PATTERN = '/^[XYZ\d]\d{7,7}[^UIOÑ\d]$/u';
    private const CONTROL_LETTER_MAP = 'TRWAGMYFPDXBNJZSQVHLCKE';

    private string $dni;

    public function __construct(string $dni)
    {
        $this->checkDniHasValidLength($dni);

        $number = (int)substr($dni, 0, -1);
        $letter = substr($dni, -1);

        $mod = $number % 23;


        if ($letter !== self::CONTROL_LETTER_MAP[$mod]) {
            throw new InvalidArgumentException('Invalid dni');
        }
        $this->dni = $dni;
    }

    private function checkDniHasValidLength(string $dni): void
    {
        if (!preg_match(self::VALID_DNI_PATTERN, $dni)) {
            throw new DomainException('Bad format');
        }
    }

    public function __toString(): string
    {
        return $this->dni;
    }
}
