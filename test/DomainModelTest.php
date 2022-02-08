<?php
use PHPUnit\Framework\TestCase;

use DomainModel\Product;
use DomainModel\Contract;
use Money\Money;


class DomainModelTest extends TestCase
{
    function testCanWordProductDefineRevenue()
    {
        
        $word = Product::wordProcessor("thinking Word");

        //контракт подписан на Оффис процессор на 200 Долларов
        //такогото числа
        $contract = new Contract($word, Money::USD(200),
            new DateTime('2021-02-01'));
        
        $word->calculateRevenueDefinitions($contract);

        // var_dump($contract->getDefinedRevenue(new DateTime('2021-03-25')));

        //Доход после заданой даты возрос
        $this->assertEquals($contract->getDefinedRevenue(new DateTime('2021-03-25')), 
            Money::USD(200));

        //Дохода до заданой даты не было
        $this->assertEquals($contract->getDefinedRevenue(new DateTime('2021-01-30')), 
            Money::USD(0));
    }

    /**
     * Тест автоматической стратегии выбора разбиения дохода определенного типа продукта на период
     */
    function testCanComplexProductDefineRevenue()
    {
        //контракт подписан на Оффис процессор на 200 Долларов
        //такогото числа
        $targetCount = Money::USD(200);
        $alloc = $targetCount->allocateTo(3);
        $revenueDate = new DateTime('2021-01-01');

        $contract = new Contract(
            Product::spreadsheet("thinking calc"), 
            $targetCount,
            $revenueDate
        );
        
        $contract->calculateRevenueDefinitions();

        // var_dump($contract->getDefinedRevenue(new DateTime('2021-01-01')));

        $this->assertEquals($contract->getDefinedRevenue(new DateTime('2020-12-31')),
            Money::USD(0) 
        );

        $this->assertEquals($contract->getDefinedRevenue($revenueDate),
            $alloc[0]
        );

        $this->assertEquals($contract->getDefinedRevenue(
            (clone $revenueDate)->add(
                new \DateInterval('P60D')
            )
        ),
            $alloc[0]->add($alloc[1])
        );

        $this->assertEquals($contract->getDefinedRevenue(
            (clone $revenueDate)->add(
                new \DateInterval('P90D')
            )
        ),
            $targetCount
        );

     
        
    }
}

?>