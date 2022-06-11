<?php

namespace ConsoleShopPHP\Cash;


interface CashInterface
{
    public function add(): void;
    public function sum(): float;
    public function empty(): void;
   // public function __toString(): string;

}
