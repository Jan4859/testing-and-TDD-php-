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
        if(strlen($dni) > self::VALID_LENGTH) throw new LengthException('Too long');
        if(strlen($dni) < self::VALID_LENGTH) throw new LengthException('Too short');
        throw new DomainException('Ends with number');
    }
}
