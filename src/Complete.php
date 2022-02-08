<?php
namespace DomainModel;

class Complete extends DefinitionStrategy
{
    function calculateRevenues(Contract $contract)
    {
        $contract->addRevenue(
            new Revenue($contract->getRevenue(), $contract->getSignedDate())
        );
    }

}

?>