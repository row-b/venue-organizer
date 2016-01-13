<?php
namespace CoreDomain\Factory;

use CoreDomain\Entity\Event as DomainEvent;
use AppBundle\Entity\Event as DbEvent;

class DbEventFactory
{
    public static function fromDomainEvent(DomainEvent $domainEvent)
    {
        $dbEvent = new DbEvent();
        $dbEvent->setId($domainEvent->getId());
        $dbEvent->setTitle($domainEvent->getTitle());

        $dbEvent->setDateWithTimeRange(
            DbDateWithTimeRangeFactory::fromDomainDateWithRimeRange(
                $domainEvent->getScheduledDateWithTimeRange()
            )
        );

        return $dbEvent;
    }
}