<?php

declare(strict_types=1);

namespace Exercise1\DNI;

use DomainException;
use Exercise1\DNI\Dni;
use LengthException;
use PHPUnit\Framework\TestCase;

class DniTest extends TestCase
{

    public function testShouldFailWhenDniLongerThanMaxLenght()
    {
        $this->expectException(LengthException::class);
        $dni = new Dni('0123456789');
    }

    public function testShouldFailWhenDniShorterThanMinLenght(): void
    {
        $this->expectException(LengthException::class);
        $dni = new Dni('01234567');
    }

    public function testShouldFailWhenEndsWithANumber(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Ends with number');
        $dni = new Dni('012345678');
    }

    public function testShouldFailWhenDniEndsWithAnInvalidLetter(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Ends with invalid letter');
        $dni = new Dni('01234567I');
    }
}
