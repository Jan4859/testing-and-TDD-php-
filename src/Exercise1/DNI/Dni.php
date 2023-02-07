<?php

declare(strict_types=1);

namespace Exercise1\DNI;

use DomainException;
use InvalidArgumentException;

class Dni
{
    private const VALID_DNI_PATTERN = '/^[XYZ\d]\d{7,7}[^UIOÑ\d]$/u';

    private string $dni;

    public function __construct(string $dni)
    {
        $this->checkDniHasValidLength($dni);

        if ('00000000T' !== $dni) {
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
