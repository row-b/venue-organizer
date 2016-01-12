<?php
namespace CoreDomain\tests\ValueObject\DateTime;


use CoreDomain\ValueObject\DateTime\Time;

class TimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $validTime
     * @dataProvider validTimeStringProvider
     */
    public function testValidTimeFromString($validTime)
    {
        $time = Time::fromString($validTime);
        $this->assertEquals($validTime, $time);
    }

    /**
     * @param int $hours
     * @param int $minutes
     * @dataProvider validTimeValuesProvider
     */
    public function testValidTimeFromValues($hours, $minutes)
    {
        $time = Time::fromValues($hours, $minutes);
        $expectedTime = sprintf('%02d%s%02d', $hours, Time::DELIMITER, $minutes);
        $this->assertEquals($expectedTime, $time);
    }

   /**
    * @param string $invalidTime
    * @expectedException \CoreDomain\Exception\InvalidArgumentValidationException
    * @dataProvider invalidTimeStringProvider
    */
    public function testInvalidTimeFromString($invalidTime)
    {
        Time::fromString($invalidTime);
    }

    /**
     * @param int $hours
     * @param int $minutes
     * @expectedException \CoreDomain\Exception\InvalidArgumentValidationException
     * @dataProvider invalidTimeValuesProvider
     */
    public function testInvalidTimeFromValues($hours, $minutes)
    {
        Time::fromValues($hours, $minutes);
    }

    public function validTimeStringProvider()
    {
        return [
            ["00:00"],
            ["23:59"]
        ];
    }

    public function validTimeValuesProvider()
    {
        return [
            [0, 0],
            [23, 59]
        ];
    }

    /**
     * @return array
     */
    public function invalidTimeStringProvider()
    {
        return [
            ["xx:xx"],
            ["01:5"],
            ["1:55"],
            ["01:61"],
            ["24:01"],
            ["12.16"]
        ];
    }

    /**
     * @return array
     */
    public function invalidTimeValuesProvider()
    {
        return [
            ['x','y'],
            ['x',1],
            [1,'y'],
            [1,60],
            [24,1]
        ];
    }
}
