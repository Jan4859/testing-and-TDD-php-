<?php

declare(strict_types=1);

namespace Exercise1\DNI;

use DomainException;
use Exercise1\DNI\Dni;
use InvalidArgumentException;
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
        $dni = new Dni('012345678');
    }

    public function testShouldFailWhenDniEndsWithAnInvalidLetter(): void
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('01234567I');
    }

    public function testShouldFailWhenDniStartsWithALetterOtherThanXYZ(): void
    {
        $this->expectException(DomainException::class);
        $dni = new Dni('A1234567R');
    }

    public function testShouldFailWhenInvalidDni(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $dni = new Dni('00000000S');
    }
}
