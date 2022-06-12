<?php

namespace ConsoleShopPHP\appInterface\Items;


interface ItemsInterface
{
    public function add(): void;
    public function itemAll(): string;
    public function empty(): void;
   // public function __toString(): string;
}
