<?php
    declare(strict_types=1);

    namespace Tests\Test2\Luhn;

    use Test2\Luhn\LuhnValidator;
    use PHPUnit\Framework\TestCase;

    class LuhnValidatorTest extends TestCase
    {
        public function testShouldValidateAllZeros(): void
        {
            $validator = new LuhnValidator();
            $this->assertTrue($validator->isValid('00000000000'));
        }
    }
