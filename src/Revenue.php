<?php
namespace DomainModel;

use Money\Money;

class Revenue
{
    private $amount;
    private $date;

    function __construct(Money $amount, $date)
    {
        $this->amount = $amount;
        $this->date = $date;
    }

    function getAmount()
    {
        return $this->amount;
    }

    function isAbleToDefinedBy(\DateTime $date)
    {
        return $date > $this->date || $date == $this->date;
    }
}