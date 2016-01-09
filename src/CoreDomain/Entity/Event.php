<?php
namespace CoreDomain\Entity;


use CoreDomain\Exception\DomainRuleException;
use CoreDomain\ValueObject\DateTime\DateWithTimeRange;
use CoreDomain\ValueObject\Text\String;
use CoreDomain\ValueObject\Id\UUId;

class Event
{
    /**
     * @var UUid
     */
    private $id;

    /**
     * @var String
     */
    private $title;

    private $dateWithTimeRange;

    public function __construct(UUId $id, String $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * @return UUId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getScheduledDateWithTimeRange()
    {
        return $this->dateWithTimeRange;
    }

    /**
     * @return bool
     */
    public function isScheduled()
    {
        if ($this->dateWithTimeRange !== null) {
            return true;
        }

        return false;
    }

    /**
     * @param DateWithTimeRange $dateWithTimeRange
     * @throws DomainRuleException
     */
    public function schedule(DateWithTimeRange $dateWithTimeRange)
    {
        if ($this->isScheduled()) {
            throw new DomainRuleException();
        }

        $this->dateWithTimeRange = $dateWithTimeRange;
    }

    /**
     * @throws DomainRuleException
     */
    public function unSchedule()
    {
        if (!$this->isScheduled()) {
            throw new DomainRuleException();
        }

        $this->dateWithTimeRange = null;
    }

    /**
     * @param DateWithTimeRange $dateWithTimeRange
     * @throws DomainRuleException
     */
    public function reschedule(DateWithTimeRange $dateWithTimeRange)
    {
        if (!$this->isScheduled()) {
            throw new DomainRuleException();
        }

        $this->dateWithTimeRange = $dateWithTimeRange;
    }
}