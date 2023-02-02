<?php

declare(strict_types=1);


namespace Test1\Shop;

use PHPUnit\Framework\TestCase;
//use UnderflowException;
//any difficulty in testing could be a clue to a design problem.
/**
 * In this test we check our cart, as we can see all the tests have an accurate description. 
 * 1. When A user click on a product, a cart has to be created and then the product added. 
 * 2. Now we have an empty cart and we try to add a product.
 * 3. The same but we try to add a different quantity.
 * 4. We test with more than one product.
 * 5. We add products in different moments so we can check they add each other and don't override. 
 * 6. 
 */
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
        $cart  = Cart::pickUp(); //Pick up empty cart.
        $cart2 = Cart::pickUp(); //Pick up empty cart.

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


    public function testEmptyCartShouldHaveZeroAmount(): void
    {
        $cart = Cart::pickUp();

        $this->assertEquals(0, $cart->amount());
    }

    public function testShouldCalculateAmountWhenAddingProduct(): void
    {
        $cart = Cart::pickUp();

        $product = $this->getProduct('product-01', 10);
        $cart->addProductInQuantity($product, 1);

        $this->assertEquals(10, $cart->amount());
    }

    public function testShouldTakeCareOfQuantitiesToCalculateAmount(): void
    {
        $cart = Cart::pickUp();

        $product = $this->getProduct('product-01', 10);
        $cart->addProductInQuantity($product, 3);

        $this->assertEquals(30, $cart->amount());
    }

    public function testShouldTakeCareOfQuantitiesAndDifferentProductsToCalculateAmount(): void
    {
        $cart = Cart::pickUp();

        $product1 = $this->getProduct('product-01', 10);
        $product2 = $this->getProduct('product-02', 7);

        $cart->addProductInQuantity($product1, 3);
        $cart->addProductInQuantity($product2, 4);

        $this->assertEquals(58, $cart->amount());
    }


    public function testShouldFailRemovingNonExistingProduct(): void
    {
        $cart = Cart::pickUp();

        $product = $this->getProduct('product-1', 10);

        $this->expectException(\UnderflowException::class);
        $cart->removeProduct($product);

        /**
         * In the context of namespaces, it's used to specify the fully-qualified name of a class, including its namespace. For example, if you have a class named Foo in the namespace Bar, you would refer to it as \Bar\Foo. This allows you to distinguish between two classes with the same name that are in different namespaces.
         * so we can use UnderflowException without add "use use UnderflowException;".
         */
    }

    public function testShouldLeaveNoProductWhenRemovingTheLastOne(): void
    {
        $cart = Cart::pickUp();

        $product = $this->getProduct('product-1', 10);

        $cart->addProductInQuantity($product, 1);
        $cart->removeProduct($product);

        $this->assertEquals(0, $cart->count());
    }

    public function testShouldLeaveOneProduct(): void
    {
        $cart = Cart::pickUp();

        $product = $this->getProduct('product-1', 10);

        $cart->addProductInQuantity($product, 2);
        $cart->removeProduct($product);

        $this->assertEquals(1, $cart->count());
    }

    public function testShouldEmptyTheCart(): void
    {
        $cart = Cart::pickUp();

        $product = $this->getProduct('product-1', 10);
        $cart->addProductInQuantity($product, 2);

        $cart->drop();

        $this->assertEmpty($cart);
    }

    public function testShouldReportIsEmpty(): void
    {
        $cart = Cart::pickUp();

        $this->assertTrue($cart->isEmpty());
    }

    public function testShouldReportIsNotEmpty(): void
    {
        $cart = Cart::pickUp();

        $product = $this->getProduct('product-1', 10);
        $cart->addProductInQuantity($product, 2);

        $this->assertFalse($cart->isEmpty());
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
