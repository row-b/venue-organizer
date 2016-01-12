<?php
namespace CoreDomain\ValueObject\DateTime;

use CoreDomain\Assert\Assertion;

/**
 * Value Object to represent time hours, minutes in hh:mm string
 * - minimum "00:00"
 * - maximum "23:59"
 */
class Time
{
    const DELIMITER = ':';
    /**
     * @var int
     */
    private $hours;

    /**
     * @var int
     */
    private $minutes;

    private function __construct(){}

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTime();
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return sprintf('%02d%s%02d', $this->hours, self::DELIMITER, $this->minutes);
    }

    public static function fromString($time)
    {
        Assertion::length($time, 5);

        $hours = substr($time, 0, 2);
        $minutes = substr($time, 3, 2);
        $delimiter = substr($time, 2, 1);

        Assertion::same($delimiter, self::DELIMITER);
        Assertion::range($hours, 0, 23);
        Assertion::range($minutes, 0, 59);

        $time = new Time();
        $time->hours = $hours;
        $time->minutes = $minutes;

        return $time;
    }

    /**
     * @param int $hours
     * @param int $minutes
     * @return Time
     * @throws InvalidArgumentException
     */
    public static function fromValues($hours, $minutes)
    {
        Assertion::range($hours, 0, 23);
        Assertion::range($minutes, 0, 59);

        $time = new Time();
        $time->hours = $hours;
        $time->minutes = $minutes;

        return $time;
    }
}
