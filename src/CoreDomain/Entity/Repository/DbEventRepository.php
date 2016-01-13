<?php
namespace CoreDomain\Entity\Repository;


use AppBundle\Entity\Repository\EventRepository;
use CoreDomain\Entity\Event as DomainEvent;

use CoreDomain\Factory\DbEventFactory;
use CoreDomain\Factory\DomainEventFactory;
use CoreDomain\ValueObject\Id\UUId;
use Doctrine\ORM\EntityManager;

class DbEventRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param UUId $id
     * @return DomainEvent
     */
    public function find(UUId $id)
    {
       $dbEvent = $this->getEventRepository()->find($id);

       return DomainEventFactory::fromDbEvent($dbEvent);
    }

    /**
     * @param DomainEvent $domainEvent
     */
    public function add(DomainEvent $domainEvent)
    {
        $dbEvent = DbEventFactory::fromDomainEvent($domainEvent);
        $this->em->persist($dbEvent);
        $this->em->flush();
    }

    private function getEventRepository()
    {
        return $this->em->getRepository('AppBundle:Event');
    }
}