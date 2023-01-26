<?php
declare(strict_types=1);

namespace Test1\Shop;

class CartLine {
    private $product;
    private $quantity;


    public function __construct($product,$quantity){
        $this->product  = $product;
        $this->quantity = $quantity;
    }

    public function product(){
        return $this->product;
    }

    public function quantity(){
        return $this->quantity;
    }
}