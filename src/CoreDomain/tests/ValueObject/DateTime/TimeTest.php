<?php
namespace CoreDomain\tests\ValueObject\DateTime;


use CoreDomain\ValueObject\DateTime\Time;

class TimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $validTime
     * @dataProvider validTimeProvider
     */
    public function testValidTime($validTime)
    {
        $time = new Time($validTime);
        $this->assertEquals($validTime, $time->getTime());
    }

    /**
     * @param string $invalidTime
     * @expectedException \CoreDomain\Exception\InvalidArgumentValidationException
     * @dataProvider invalidTimeProvider
     */
    public function testInvalidFormatThrowsException($invalidTime)
    {
        new Time($invalidTime);
    }

    public function validTimeProvider()
    {
        return [
            ["00:00"],
            ["23:59"]
        ];
    }

    /**
     * @return array
     */
    public function invalidTimeProvider()
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
}
