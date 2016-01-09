<?php
namespace CoreDomain\tests\Entity;


use CoreDomain\Entity\Event;
use CoreDomain\ValueObject\DateTime\DateWithTimeRange;
use CoreDomain\ValueObject\Id\UUId;
use CoreDomain\ValueObject\Text\String;


class EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Event
     */
    protected $event;

    /**
     * @var UUId
     */
    protected $id;

    /**
     * @var String
     */
    protected $title;

    /**
     * @var DateWithTimeRange
     */
    protected $dateWithTimeRange;

    protected function setUp()
    {
        $this->id = new UUId('add17710-b70a-11e5-a837-0800200c9a66');
        $this->title = new String('Title of this event');
        $this->dateWithTimeRange = new DateWithTimeRange(new \DateTimeImmutable('2010-01-01'));
    }

    /**
     * @expectedException \CoreDomain\Exception\DomainRuleException
     */
    public function testUnScheduleUnScheduleEvent()
    {
        $unscheduledEvent = $this->getUnScheduledEvent();
        $unscheduledEvent->unSchedule();
    }

    /**
     * @expectedException \CoreDomain\Exception\DomainRuleException
     */
    public function testScheduleScheduledEvent()
    {
        $scheduledEvent = $this->getScheduledEvent();
        $scheduledEvent->schedule($this->dateWithTimeRange);
    }

    /**
     * @expectedException \CoreDomain\Exception\DomainRuleException
     */
    public function testRescheduleUnscheduledEvent()
    {
        $unscheduledEvent = $this->getUnScheduledEvent();
        $unscheduledEvent->unSchedule();

    }

    public function rescheduleEvent()
    {
        $scheduledEvent = $this->getScheduledEvent();
        $newDateWithTimeRange = new DateWithTimeRange(new \DateTimeImmutable("2005-12-24"));

        $scheduledEvent->reschedule($newDateWithTimeRange);
        $this->assertTrue($scheduledEvent->isScheduled());
        $this->assertEquals($newDateWithTimeRange, $scheduledEvent->getScheduledDateWithTimeRange());
    }

    /**
     * @return Event
     */
    public function getUnScheduledEvent()
    {
        $unscheduledEvent = new Event($this->id, $this->title);

        $this->assertFalse($unscheduledEvent->isScheduled());
        $this->assertEquals($this->id, $unscheduledEvent->getId());
        $this->assertEquals($this->title, $unscheduledEvent->getTitle());

        return $unscheduledEvent;
    }

    /**
     * @return Event
     */
    public function getScheduledEvent()
    {
        $event = $this->getUnScheduledEvent();
        $event->schedule($this->dateWithTimeRange);
        $this->assertTrue($event->isScheduled());
        $this->assertEquals($this->dateWithTimeRange, $event->getScheduledDateWithTimeRange());

        return $event;
    }
}
