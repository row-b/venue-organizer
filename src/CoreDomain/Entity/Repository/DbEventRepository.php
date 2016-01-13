<?php
namespace CoreDomain\Entity\Repository;


use AppBundle\Entity\Repository\EventRepository;
use CoreDomain\Entity\Event as DomainEvent;

use CoreDomain\Factory\DbEventFactory;
use CoreDomain\ValueObject\Id\UUId;
use Doctrine\ORM\EntityManager;

class DbEventRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function find(UUId $id)
    {
       $event = $this->eventRepository->find($id);
    }

    public function add(DomainEvent $domainEvent)
    {
        $dbEvent = DbEventFactory::fromDomainEvent($domainEvent);
        $this->em->persist($dbEvent);
        $this->em->flush();
    }
}