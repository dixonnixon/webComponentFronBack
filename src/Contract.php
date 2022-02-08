<?php
namespace DomainModel;

use Money\Money;
use Money\Currency;


class Contract
{
    private $definedRevenues;//List

    private $product;
    private $revenue;
    private $signedDate;
    private $id;

    function __construct(Product $prod, Money $revenue, $signedDate)
    {
        $this->revenues = new \ArrayObject();

        $this->product = $prod;
        $this->revenue = $revenue;
        $this->signedDate = $signedDate;
    }

    function getDefinedRevenue($date)
    {
        $result = new Money(0, new Currency('USD'));
        $iterator = $this->revenues->getIterator();
        // var_dump("all revs", $this->revenues);
        // var_dump("Iter", $iterator);
        while($iterator->valid())
        {
            $revenue = $iterator->current();
            if($revenue->isAbleToDefinedBy($date))
            {
                $result = $result->add($revenue->getAmount());
            }
            $iterator->next();
        }
        return $result;
    }

    function calculateRevenueDefinitions()
    {
        $this->product->calculateRevenueDefinitions($this);
    }

    function getRevenue()
    {
        return $this->revenue;
    }

    function getSignedDate()
    {
        return $this->signedDate;
    }

    function addRevenue(Revenue $revenue)
    {
        $this->revenues->offsetSet($this->revenues->count(), $revenue);
        // var_dump("afterAdd", $this->revenues);
    }
}