<?php
namespace DomainModel;

class ThreeWay extends DefinitionStrategy
{
    private $firstOffset;
    private $secondOffset;

    function __construct($firstOffset, $secondOffset)
    {
        $this->firstOffset = $firstOffset;
        $this->secondOffset = $secondOffset;
    }

    function calculateRevenues(Contract $contract)
    {
        $allocaion = $contract->getRevenue()->allocateTo(3);
        // var_dump($allocaion);
        $date = clone $contract->getSignedDate();

        $date1 = (clone $date)
            ->add(new \DateInterval('P'.$this->firstOffset.'D'));

        $date2 =  (clone $date)
            ->add(new \DateInterval('P'.$this->secondOffset.'D'));

        $contract->addRevenue(
            new Revenue($allocaion[0], $date)
        );

        $contract->addRevenue(
            new Revenue($allocaion[1], $date1)
        );

        $contract->addRevenue(
            new Revenue($allocaion[2], $date2)
        );
    }
}

?>