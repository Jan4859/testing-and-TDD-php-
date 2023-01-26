<?php
declare(strict_types=1);

namespace Test1\Shop;

interface ProductInterface
{
    public function id(): string;

    public function price(): float;
}