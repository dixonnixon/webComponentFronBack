<?php
namespace DomainModel;

abstract class DefinitionStrategy
{
    abstract function calculateRevenues(Contract $contract);
}