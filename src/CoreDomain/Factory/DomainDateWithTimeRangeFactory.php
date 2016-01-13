<?php
namespace CoreDomain\Factory;

use AppBundle\Entity\DateWithTimeRangeEmbeddable;
use CoreDomain\ValueObject\DateTime\DateWithTimeRange;
use CoreDomain\ValueObject\DateTime\Time;

class DomainDateWithTimeRangeFactory
{
    /**
     * @param DateWithTimeRangeEmbeddable|null $dateWithTimeRangeEmbeddable
     * @return DateWithTimeRange|null
     */
    public static function fromDateWithTimeRangeEmbeddable(DateWithTimeRangeEmbeddable $dateWithTimeRangeEmbeddable = null)
    {
        $dateWithTimeRange = null;
        if ($dateWithTimeRangeEmbeddable) {
            $date = self::getDate($dateWithTimeRangeEmbeddable->getDate());
            $timeStart = self::getTime($dateWithTimeRangeEmbeddable->getTimeStart());
            $timeEnd = self::getTime($dateWithTimeRangeEmbeddable->getTimeStart());

            $dateWithTimeRange = new DateWithTimeRange($date, $timeStart, $timeEnd);
        }
        return $dateWithTimeRange;
    }

    /**
     * @param $timeString
     * @return Time|null
     */
    private static function getTime($timeString)
    {
        $time = null;
        if ($timeString) {
            $time = Time::fromString($timeString);
        }

        return $time;
    }

    private static function getDate(\DateTime $dateTime)
    {
        $dateTimeImmutible = new \DateTimeImmutable();
        $dateTimeImmutible->setTimestamp($dateTime->getTimestamp());
        return $dateTimeImmutible;
    }
}