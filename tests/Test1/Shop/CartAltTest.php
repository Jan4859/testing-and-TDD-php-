<?php

declare(strict_types=1);


namespace Test1\Shop;

use PHPUnit\Framework\TestCase;

//any difficulty in testing could be a clue to a design problem.
class CartAltTest extends TestCase
{
    public function testShouldInstantiateCartWithAPreselectedProduct(): void
    {
        $product2 = $this->getProduct2('product-1', 10); //We need a product to add to our cart. In this cases with a mock
        $product = $this->getProduct('product-1', 10); //Without mock, we use the real product class. 
        $cart  = Cart::pickUpWithProduct($product, 1); //Instance a cart with products, it can't be empty. 
        $cart2 = Cart::pickUpWithProduct($product2, 1);

        $this->assertNotEmpty($cart->id());
        $this->assertEquals(1, $cart->totalProducts());
        $this->assertEquals(1, $cart2->totalProducts());
    }


    public function testShouldAddAProduct(): void
    {
        $product = $this->getProduct('product-1', 10); //We make a product.
        $cart = Cart::pickUp(); //Pick up empty cart.

        $cart->addProductInQuantity($product, 1); //We add 1 product to our cart.

        $this->assertCount(1, $cart); //Check is the cart has 1 product.
    }

    public function testShouldAddAProductInQuantity(): void
    {
        //Same test as before but with multiple quantity(product's units).
        $product = $this->getProduct('product-1', 10);
        $cart = Cart::pickUp();

        $cart->addProductInQuantity($product, 10);

        $this->assertCount(1, $cart);
        $this->assertEquals(10, $cart->totalProducts());
    }

    public function testShouldAddSeveralProductsInQuantity(): void
    {
        //Same test as above, but this time 2 products
        $product1 = $this->getProduct('product-1', 10);
        $product2 = $this->getProduct('product-2', 15);

        $cart = Cart::pickUp();

        $cart->addProductInQuantity($product1, 5);
        $cart->addProductInQuantity($product2, 7);

        $this->assertCount(2, $cart);
        $this->assertEquals(12, $cart->totalProducts());
    }

    public function testShouldAddSameProductsInDifferentMoments(): void
    {
        $product1 = $this->getProduct('product-1', 10);
        $product2 = $this->getProduct('product-2', 15);

        $cart = Cart::pickUp();

        $cart->addProductInQuantity($product1, 5);
        $cart->addProductInQuantity($product2, 7);
        $cart->addProductInQuantity($product2, 3);

        $this->assertCount(2, $cart);
        $this->assertEquals(15, $cart->totalProducts());
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
        //If our collaborator is slow or it depends on issues outside the scope of the test. This is a fast simulation
        /** @var ProductInterface | MockObject $product */
        $product = $this->createMock(ProductInterface::class);
        $product->method('id')->willReturn($id);
        $product->method('price')->willReturn(floatval($price));

        return $product;
    }
}
