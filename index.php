<?php
declare(strict_types=1);

require_once './vendor/autoload.php';

use ConsoleShopPHP\ClassApp\Product;
use ConsoleShopPHP\ClassApp\Items;
use ConsoleShopPHP\ClassApp\Cash;

use ConsoleShopPHP\appInterface\Shop\ShopInterface;
use ConsoleShopPHP\appInterface\Exception\ProgramsException;
use ConsoleShopPHP\appInterface\Items\ItemsInterface;
use ConsoleShopPHP\appInterface\Cash\CashInterface;


try{
    echo "Enter the Product?
     Product <--> A 0.65 $,
      Product <--> B 1 $,
       Product <--> C 2,5 $,
        Product <--> D 5.75 $,
         Exit <--> E of e: \n";
echo "Input: ";
    $tabLineProduct = ["A"=>true, "B"=>true, "C"=>true, "D"=>true];

    do{
        $line = trim(handleLine());
        // Wyjscie
        exitMachine($line);  
        // Wszystkie symbole oprócz tablicy
        if(@is_null($tabLineProduct[$line])){
            $tabLineProduct[$line] = false;
        // throw new ProgramsException("empty index");
        }

        if($tabLineProduct[$line] === true){
    
            $product = new Product($line);
        
            stringoTo("The cost of the product is: ", $product);
            
            textCash(); 
    
        }else{
            echo "There is no such product symbol ABORTING!\n";
            echo "Enter the correct symbol A, B, C, D !\n";
            echo "Enter the Product?
             Product <--> A 0.65 $,
              Product <--> B 1 $,
               Product <--> C 2,5 $,
                Product <--> D 5.75 $
                 Exit <--> E of e: \n";
        }
    
    }while( $tabLineProduct[$line] !== true );
    
    $cash  = Cash::getInstance();
    $items = Items::getInstance();
    $tabLineMoney = ["P"=>true, "J"=>true, "T"=>true, "F"=>true, "D"=>true,"RM"=>false];

    do{
         echo "Input: ";
        $line = trim(handleLine());
        // Wyjscie
        exitMachine($line);
        // Wszystkie symbole oprócz tablicy
        if(@is_null($tabLineMoney[$line])){
            $tabLineMoney[$line] = -1;
           // throw new ProgramsException("empty index");
        }
    // RETURN-MONEY RM usun monety
        if($tabLineMoney[$line] === false){
                emptyCash($cash);
                emptyItems($items);
            echo "Coins cleared! \n";
            echo "Enter the symbol correctly or remove the coins\n";
        }else{

            if($tabLineMoney[$line] === true){
    
                $cash->addTypeCash($line);
                $items->addTypeItems($line);
                            // Dodaje z automatu
                            addCash($cash);
                        echo sumCash($cash)." $ ";
                            addItems($items);
                        echo allItems($items)." \n";
                    if($product->typeProduct > sumCash($cash)){
                        echo "not enough! \n\n";
                    }              
            }else{
                echo "No such cash symbol ABORTING!\n";
                textCash();
            }
        }
    }while($product->typeProduct > sumCash($cash));
    
     $c = (int)(sumCash($cash)*1000);
     $p = (int)($product->typeProduct*1000);
    
    echo 'The product purchased '.$product->typeProduct." $ and the return to the account is: ".(($c - $p)/1000)." $";
    echo "\n";
    echo "Thank you...\n\n\n\n\n";

}catch(ProgramsException $e){
    echo $e->getMessage();
}

function stringoTo($text, ShopInterface $value ):void{
         print $text.$value." $";
}

function addCash(CashInterface $cash):void{
            $cash->add();
}

function sumCash(CashInterface $cash):float{
        return $cash->sum();
}

function emptyCash(CashInterface $cash):void{
            $cash->empty();
}

function addItems(ItemsInterface $items){
            $items->add();
}

function allItems(ItemsInterface $items):string{
        return $items->itemAll();
}

function emptyItems(ItemsInterface $items){
    $items->empty();
}


function handleLine(){
    $handle = fopen ("php://stdin","r");
    $line   = fgets($handle);
    return $line;
}

function exitMachine($line):void {
    if($line == 'E' || $line == 'e'){
        echo "ABORTING!\n\n\n\n\n";
        exit;
    }
}

function textCash(){
echo "
Enter the cash correctly or remove it money: 
      0,05 $ --> P,
      0,1  $ --> J,
      0,25 $ --> T,
      0,5  $ --> F,
      1,00 $ --> D
      RETURN-MONEY --> RM Empty money
      Cash. I'm waiting? ;) : \n\n";
}
