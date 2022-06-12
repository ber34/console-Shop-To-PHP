<?php

 namespace ConsoleShopPHP\ClassApp;

 use ConsoleShopPHP\appInterface\Cash\CashInterface;

class Cash implements CashInterface {

    const P      = 0.05;
    const J      = 0.1;
    const T      = 0.25;
    const F      = 0.5;
    const D      = 1.00;

    public float $money      = 0.0;
    public float $typeCash   = 0.0;
    private static $instance = null;

    private function __construct(){

    }

    public static function getInstance(): Cash {
      if(self::$instance === null){
         self::$instance = new static(); 
      }

      return self::$instance;
    }

    private function __clone() { }

    public function addTypeCash($typeCash){
        switch($typeCash){
            case "P":
                $this->typeCash = self::P;
            break;
            case "J":
                $this->typeCash = self::J;
            break;
            case "T":
                $this->typeCash = self::T;
            break;
            case "F":
                $this->typeCash = self::F;
            break;
            case "D":
                $this->typeCash = self::D;
            break;
        }
    }

    public function add(): void {
        $this->money += $this->typeCash;
    }

    public function sum(): float {
        return $this->money;
    }

    public function empty(): void{
        $this->money = 0.0;
    }

    public function getTypeCash(): float{
      return $this->typeCash;
    }

    /*
    public function __toString(): string
    {
        return 'stringa';
    }
    */
}
