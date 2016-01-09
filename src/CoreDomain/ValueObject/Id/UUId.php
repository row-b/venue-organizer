<?php
namespace CoreDomain\ValueObject\Id;


class UUId
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}