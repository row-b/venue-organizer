<?php
namespace CoreDomain\ValueObject\DateTime;

use CoreDomain\Exception\InvalidArgumentValidationException;

/**
 * Date with optional time range.
 * - valid without $timeStart or $timeEnd set
 * - valid with only $timeStart set
 * - valid with only $timeEnd set
 *
 * The day in this time range starts at 06:00 and ends at 05:59. This means:
 * - $timeStart = "23:00", $timeEnd = "04:00" is valid
 * - $timeStart = 05:00, $timeEnd = "07:00" is NOT valid
 */
class DateWithTimeRange
{
    const START_TIME_DAY = "06:00";
    /**
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * @var Time
     */
    private $timeStart;

    /**
     * @var Time
     */
    private $timeEnd;

    /**
     * @param \DateTimeImmutable $date
     * @param Time|null $timeStart
     * @param Time|null $timeEnd
     * @throws InvalidArgumentValidationException
     */
    public function __construct(\DateTimeImmutable $date, Time $timeStart = null, Time $timeEnd = null)
    {
        $this->assertValidTimeRange($timeStart, $timeEnd);
        $this->date = $date;
        $this->timeStart = $timeStart;
        $this->timeEnd = $timeEnd;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Time
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * @return Time
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * @param Time|null $timeStart
     * @param Time|null $timeEnd
     * @throws InvalidArgumentValidationException
     */
    private function assertValidTimeRange(Time $timeStart = null, Time $timeEnd = null)
    {
        if ($timeStart && $timeEnd) {
            // both times are after self::START_TIME_DAY
            if ($timeStart->getTime() >= self::START_TIME_DAY && $timeEnd->getTime() >= self::START_TIME_DAY) {
                if ($timeStart->getTime() > $timeEnd->getTime()) {
                    throw new InvalidArgumentValidationException();
                }
                return;
            }

            // both times are after self::START_TIME_DAY
            if ($timeStart->getTime() < self::START_TIME_DAY && $timeEnd->getTime() < self::START_TIME_DAY) {
                if ($timeStart->getTime() > $timeEnd->getTime()) {
                    throw new InvalidArgumentValidationException();
                }
                return;
            }

            // one of the times is before self::START_TIME_DAY, the other one is after
            if ($timeStart->getTime() < $timeEnd->getTime()) {
                throw new InvalidArgumentValidationException();
            }
        }
    }
}
