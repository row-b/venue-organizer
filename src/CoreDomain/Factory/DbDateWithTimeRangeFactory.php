<?php
namespace CoreDomain\Factory;


use AppBundle\Entity\DateWithTimeRangeEmbeddable;
use CoreDomain\ValueObject\DateTime\DateWithTimeRange;

class DbDateWithTimeRangeFactory
{
    public static function fromDomainDateWithRimeRange(DateWithTimeRange $dateWithTimeRange)
    {
        $dateWithTimeRangeEmbeddable = new DateWithTimeRangeEmbeddable();
        $dateWithTimeRangeEmbeddable->setDate($dateWithTimeRange->getDate());
        $dateWithTimeRangeEmbeddable->setTimeStart($dateWithTimeRange->getTimeStart());
        $dateWithTimeRangeEmbeddable->setTimeEnd($dateWithTimeRange->getTimeEnd());

        return $dateWithTimeRangeEmbeddable;
    }
}