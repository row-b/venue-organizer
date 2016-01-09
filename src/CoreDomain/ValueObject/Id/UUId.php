<?php
namespace CoreDomain\ValueObject\Id;


class UUId
{
    /**
     * @var string
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }
}