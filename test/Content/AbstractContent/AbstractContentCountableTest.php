<?php

/**
 * Class AbstractContentTest
 * @group content
 */
class AbstractContentCountableTest extends \AbstractContentTest
{
    /**
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::count
     */
    public function testIsCountable()
    {
        $this->assertEquals(0, count($this->content));
        $this->assertEquals(0, $this->content->count());
    }
}