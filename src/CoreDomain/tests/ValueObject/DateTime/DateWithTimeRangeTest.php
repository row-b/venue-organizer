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
            [new Time("07:00"), null],
            [null, new Time("20:00")],
            [new Time("04:00", "04:00")],
            [new Time("20:00", "20:00")],
            [new Time("00:00", "05:59")],
            [new Time("06:00", "23:59")],
            [new Time("06:00", "05:59")]
        ];
    }

    /**
     * @return array
     */
    public function invalidTimeRangeProvider()
    {
        return [
            [new Time("20:00"), new Time("18:00")],
            [new Time("04:00"), new Time("01:00")],
            [new Time("05:59"), new Time("06:00")]
        ];
    }
}
