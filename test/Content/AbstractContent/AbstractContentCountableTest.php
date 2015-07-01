<?php

use \t1gor\RobotsTxt\Content\EmptyContent;

/**
 * Class AbstractContentTest
 */
class AbstractContentCountableTest extends \AbstractContentTest
{
    /**
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::count
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::length
     */
    public function testIsCountable()
    {
        $this->assertEquals(0, count($this->content));
        $this->assertEquals(0, $this->content->count());
        $this->assertEquals(0, $this->content->length());
    }
}