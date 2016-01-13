<?php

namespace AppBundle\Controller;

use CoreDomain\Entity\Event;
use CoreDomain\Entity\Repository\DbEventRepository;
use CoreDomain\Factory\DbEventFactory;
use CoreDomain\ValueObject\DateTime\DateWithTimeRange;
use CoreDomain\ValueObject\DateTime\Time;
use CoreDomain\ValueObject\Id\UUId;
use CoreDomain\ValueObject\Text\String;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @param Request
     * @Route(name="homepage", )
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dbEventRepository = new DbEventRepository($em);

        /*
        $date = new \DateTimeImmutable("2010-12-23");
        $timeStart = Time::fromString("20:00");
        $timeEnd = Time::fromString("03:00");
        $dateWithTimeRange = new DateWithTimeRange($date, $timeStart, $timeEnd);

        $event = new Event(new UUId(), new String("Dit is mijn tweede event"));
        $event->schedule($dateWithTimeRange);
        $em = $this->getDoctrine()->getManager();

        $dbEventRepository = new DbEventRepository($em);
        $dbEventRepository->add($event);

        echo "success"; die;
        */
        $UUId = new UUId('a276885b-8cd8-4d6a-8bd3-078965ac2078');
        $event = $dbEventRepository->find($UUId);

        var_dump($event);
        die;
    }
}
