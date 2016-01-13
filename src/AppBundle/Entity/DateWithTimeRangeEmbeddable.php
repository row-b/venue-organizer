<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class DateWithTimeRangeEmbeddable
{
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $timeStart;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $timeEnd;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * @param mixed $timeStart
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;
    }

    /**
     * @return mixed
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * @param mixed $timeEnd
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;
    }
}
