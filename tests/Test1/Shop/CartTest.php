<?php
declare(strict_types=1);


namespace Test1\Shop;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testShouldInstantiateAnEmptyCartIdentifiedWithAnId(): void
    {
        $cart = Cart::pickUp();
        
        $this->assertNotEmpty($cart->id()); //Check if the parameter id(recently created) is not empty
        $this->assertEquals(0, $cart->totalProducts());//Check if the await valued is equal to the  second action.
    }
}