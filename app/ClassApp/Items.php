<?php
 
 namespace ConsoleShopPHP\ClassApp;

 use ConsoleShopPHP\Items\ItemsInterface;

class Items implements ItemsInterface {
    
    public string $item      ='';
    private static $instance = null;
    public string $typeItems;

    private function __construct(){

    }

    public static function getInstance(): Items {
        if(self::$instance === null){
            self::$instance = new static(); 
        }

        return self::$instance;
    }

    public function addTypeItems($typeItems){
        $this->typeItems = $typeItems;
    }

    public function add(): void{
        $this->item .= " ".$this->typeItems;
    }

    public function itemAll(): string{
        return $this->item;
    }

    public function empty(): void{
        $this->item = "";
    }

    public function __toString(): string
    {
        return $this->typeItems;
    }
}
