<?php
declare(strict_types=1);


namespace Test1\Shop;

use PHPUnit\Framework\TestCase;

class CartAltTest extends TestCase
{
    public function testShouldInstantiateCartWithAPreselectedProduct(): void
    {
        $product2 = $this->getProduct2('product-1', 10);
        $product = $this->getProduct('product-1', 10);
        $cart  = Cart::pickUpWithProduct($product, 1);
        $cart2 = Cart::pickUpWithProduct($product2, 1);

        $this->assertNotEmpty($cart->id());
        $this->assertEquals(1, $cart->totalProducts());
        $this->assertEquals(1, $cart2->totalProducts());
    }

    private function getProduct($id, $price): ProductInterface
    {
        return new Product($id, $price);
    }

    /**
     * get Product with a mock
     */
    private function getProduct2($id, $price): ProductInterface
    {
        /** @var ProductInterface | MockObject $product */
        $product = $this->createMock(ProductInterface::class);
        $product->method('id')->willReturn($id);
        $product->method('price')->willReturn(floatval($price));
        
        return $product;
    }
}