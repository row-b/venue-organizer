<?php
namespace CoreDomain\ValueObject\Text;


class String
{
    /**
     * @var string
     */
    private $string;

    /**
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function __ToString()
    {
        return $this->string;
    }
}