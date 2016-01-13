<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Embedded(
     *     class="AppBundle\Entity\DateWithTimeRangeEmbeddable",
     *     columnPrefix="date_with_time_range_"
     * )
     */
    private $dateWithTimeRange;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDateWithTimeRange()
    {
        return $this->dateWithTimeRange;
    }

    /**
     * @param mixed $dateWithTimeRange
     */
    public function setDateWithTimeRange($dateWithTimeRange)
    {
        $this->dateWithTimeRange = $dateWithTimeRange;
    }


}