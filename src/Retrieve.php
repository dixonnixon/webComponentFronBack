<?php
namespace DomainModel;

interface Retrieve
{
    public function findAll(): Array;
    public function findById($id);
    public function meta();
}

?>