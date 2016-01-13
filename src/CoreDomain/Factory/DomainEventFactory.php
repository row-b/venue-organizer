<?php
namespace CoreDomain\Factory;

use CoreDomain\Entity\Event as DomainEvent;
use AppBundle\Entity\Event as DbEvent;
use CoreDomain\ValueObject\Id\UUId;
use CoreDomain\ValueObject\Text\String;

class DomainEventFactory
{
    /**
     * @param DbEvent $dbEvent
     * @return DomainEvent
     * @throws \CoreDomain\Exception\DomainRuleException
     */
    public static function fromDbEvent(DbEvent $dbEvent)
    {
        $domainEvent = new DomainEvent(
            new UUId($dbEvent->getId()),
            new String($dbEvent->getTitle())
        );
        $dateWithTimeRange = DomainDateWithTimeRangeFactory::fromDateWithTimeRangeEmbeddable(
            $dbEvent->getDateWithTimeRange()
        );

        if ($dateWithTimeRange) {
            $domainEvent->schedule($dateWithTimeRange);
        }

        return $domainEvent;
    }
}