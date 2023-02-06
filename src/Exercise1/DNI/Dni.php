<?php

declare(strict_types=1);

namespace Exercise1\DNI;

use DomainException;
use LengthException;
class Dni
{
    public function __construct(string $dni)
    {
        if(strlen($dni) > 9) throw new LengthException('Too long');
        if(strlen($dni) < 9) throw new LengthException('Too short');
        throw new DomainException('Ends with number');
    }
}
