<?php
namespace CoreDomain\ValueObject\DateTime;

use CoreDomain\Exception\InvalidArgumentValidationException;

/**
 * Value Object to represent time hours, minutes in hh:mm string
 * - minimum "00:00"
 * - maximum "23:59"
 */
class Time
{
    /**
     * @var string
     */
    private $time;

    /**
     * @param string $time
     * @throws InvalidArgumentValidationException
     */
    public function __construct($time)
    {
        $this->assertValidTime($time);
        $this->time = $time;
    }

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
        return $this->time;
    }

    /**
     * @param string $time
     * @throws InvalidArgumentValidationException
     */
    private function assertValidTime($time)
    {
        $pattern = '/^(\d{2}):(\d{2})$/';
        preg_match($pattern, $time, $matches);

        // first check format (Note: 34:67 is still valid)
        if (!$matches) {
            throw new InvalidArgumentValidationException();
        }

        // check valid time
        if ((int)$matches[1] > 23 || (int)$matches[2] > 59) {
            throw new InvalidArgumentValidationException();
        }
    }

}
