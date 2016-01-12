<?php
namespace CoreDomain\Assert;

use Assert\Assertion as BaseAssertion;
use CoreDomain\ValueObject\DateTime\Time;

class Assertion extends BaseAssertion
{
    const INVALID_TIME_RANGE = 300;

    protected static $exceptionClass = 'CoreDomain\Exception\InvalidArgumentValidationException';


    /**
     * Assert that two values are equal (using == ).
     *
     * @param mixed $value
     * @param mixed $value2
     * @param string|null $message
     * @param string|null $propertyPath
     * @return void
     * @throws \Assert\AssertionFailedException
     */
    public static function timeRange(
        Time $timeStartDay,
        Time $timeStart = null,
        Time $timeEnd = null,
        $message = null,
        $propertyPath = null)
    {
        $errorMessage = sprintf(
            $message ?: 'Time "%s" is not before %s starting the day at "%s".',
            $timeStart,
            $timeEnd,
            $timeStartDay
        );

        if ($timeStart && $timeEnd) {
            // both times are after $timeStartDay
            if ($timeStart->getTime() >= $timeStartDay && $timeEnd->getTime() >= $timeStartDay) {
                if ($timeStart->getTime() > $timeEnd->getTime()) {
                    throw static::createException(sprintf('%s - %s', $timeStart, $timeEnd) , $message, static::INVALID_TIME_RANGE, $propertyPath, array());
                }
                return;
            }

            // both times are after $timeStartDay
            if ($timeStart->getTime() < $timeStartDay && $timeEnd->getTime() < $timeStartDay) {
                if ($timeStart->getTime() > $timeEnd->getTime()) {
                    throw static::createException(sprintf('%s - %s', $timeStart, $timeEnd) , $message, static::INVALID_TIME_RANGE, $propertyPath, array());
                }
                return;
            }

            // one of the times is before $timeStartDay, the other one is after
            if ($timeStart->getTime() < $timeEnd->getTime()) {
                throw static::createException(sprintf('%s - %s', $timeStart, $timeEnd) , $message, static::INVALID_TIME_RANGE, $propertyPath, array());
            }
        }
    }
}