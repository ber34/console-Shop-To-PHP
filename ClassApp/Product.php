<?php

 namespace ConsoleShopPHP\ClassApp;

 use ConsoleShopPHP\Shop\ShopInterface;

class Product implements ShopInterface {

    const A = 0.65;
    const B = 1;
    const C = 2.5;
    const D = 5.75;

    public $typeProduct;

    function __construct($typeProduct){
       
        switch($typeProduct){
            case "A":
                $this->typeProduct = self::A;
            break;
            case "B":
                $this->typeProduct = self::B;
            break;
            case "C":
                $this->typeProduct = self::C;
            break;
            case "D":
                $this->typeProduct = self::D;
            break;
        }
    }

    public function __toString(): string
    {
        return $this->typeProduct;
    }
}