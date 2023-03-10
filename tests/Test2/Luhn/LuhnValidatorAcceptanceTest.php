<?php

    declare(strict_types=1);

    namespace Tests\Test2\Luhn;

    use Test2\Luhn\LuhnValidator;
    use PHPUnit\Framework\TestCase;

    class LuhnValidatorAcceptanceTest extends TestCase
    {
        public function testShouldValidateRealCardNumber(): void
        {
            $validator = new LuhnValidator();
            $this->assertTrue($validator->isValid('49927398716'));
        }
    }
