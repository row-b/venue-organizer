<?php
namespace CoreDomain\tests\ValueObject\DateTime;


use CoreDomain\ValueObject\DateTime\DateWithTimeRange;
use CoreDomain\ValueObject\DateTime\Time;

class DateWithTimeRangeTest extends \PHPUnit_Framework_TestCase
{
    protected $date;

    protected function setUp()
    {
        $this->date = new \DateTimeImmutable("2000-01-20");
    }

    /**
     * @param Time|null $timeStart
     * @param Time|null $timeEnd
     * @dataProvider validTimeRangeProvider
     */
    public function testValidDateWithTimeRange(Time $timeStart = null, Time $timeEnd = null)
    {
        $dateWithTimeRange = new DateWithTimeRange($this->date, $timeStart, $timeEnd);
        $this->assertEquals($this->date, $dateWithTimeRange->getDate());
        $this->assertEquals($timeStart, $dateWithTimeRange->getTimeStart());
        $this->assertEquals($timeEnd, $dateWithTimeRange->getTimeEnd());
    }

    /**
     * @param Time $timeStart
     * @param Time $timeEnd
     * @dataProvider invalidTimeRangeProvider
     * @expectedException \CoreDomain\Exception\InvalidArgumentValidationException
     */
    public function testInvalidTimeRangeThrowsException(Time $timeStart, Time $timeEnd)
    {
        new DateWithTimeRange($this->date, $timeStart, $timeEnd);
    }

    /**
     * @return array
     */
    public function validTimeRangeProvider()
    {
        return [
            [null, null],
            [Time::fromString("07:00"), null],
            [null, Time::fromString("20:00")],
            [Time::fromString("04:00"), Time::fromString("04:00")],
            [Time::fromString("20:00"), Time::fromString("20:00")],
            [Time::fromString("00:00"), Time::fromString("05:59")],
            [Time::fromString("06:00"), Time::fromString("23:59")],
            [Time::fromString("06:00"), Time::fromString("05:59")]
        ];
    }

    /**
     * @return array
     */
    public function invalidTimeRangeProvider()
    {
        return [
            [Time::fromString("20:00"), Time::fromString("18:00")],
            [Time::fromString("04:00"), Time::fromString("01:00")],
            [Time::fromString("05:59"), Time::fromString("06:00")]
        ];
    }
}
