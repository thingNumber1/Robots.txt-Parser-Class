<?php

use \t1gor\RobotsTxt\Content\EmptyContent;

/**
 * Class AbstractContentEncodingTest
 * @group content
 * @group parser
 * @group encoding
 */
class AbstractContentEncodingTest extends AbstractEncodingTest
{
    /**
     * @var \t1gor\RobotsTxt\Content\EmptyContent
     */
    protected $content;

    /**
     * Set dummy content instance
     */
    public function setUp()
    {
        parent::setUp();
        $this->content = new EmptyContent();
    }

    /**
     * Clean-up
     */
    public function tearDown()
    {
        $this->content = null;
        unset($this->content);
        parent::tearDown();
    }

    /**
     * @expectedException \t1gor\RobotsTxt\Content\Exception\InvalidEncoding
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::setEncoding
     */
    public function testSetEncodingInvalidException()
    {
        $this->content->setEncoding('some-dummy-encoding');
    }
}