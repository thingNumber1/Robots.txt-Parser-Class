<?php

use \t1gor\RobotsTxt\Content\StringContent;

/**
 * Class AbstractContentGettersTest
 * @group content
 */
class AbstractContentGettersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \t1gor\RobotsTxt\Content\StringContent
     */
    protected $content;

    /**
     * Set dummy content instance
     */
    public function setUp()
    {
        $this->content = new StringContent('Allow: /some.url');
    }

    /**
     * @coversNothing
     */
    public function testNotRead()
    {
        $this->assertAttributeEmpty('content', $this);
        $this->assertEmpty($this->content->getCurrentWord());
        $this->assertEmpty($this->content->getCurrentChar());
        $this->assertEquals(0, $this->content->getCharIndex());
        $this->assertEquals(0, $this->content->count());
    }

    /**
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::increment
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::getCurrentChar
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::getCurrentWord
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::getCharIndex
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::count
     */
    public function testRead()
    {
        // prepare content and read
        $this->content->read();

        // run assertions
        $this->assertAttributeNotEmpty('content', $this);
        $this->assertNotEmpty($this->content->getCurrentWord());
        $this->assertNotEmpty($this->content->getCurrentChar());
        $this->assertNotEquals(0, $this->content->getCharIndex());
        $this->assertNotEquals(0, $this->content->count());
    }

    /**
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::getHelper
     */
    public function testGetHelper()
    {
        $helper = $this->content->getHelper();
        $this->assertInstanceOf('\t1gor\RobotsTxt\Content\HelperInterface', $helper);
    }

    /**
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::setWord
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::getCurrentWord
     */
    public function testSetWord()
    {
        // prepare content and read
        $this->content->read();

        // run assertions
        $before = $this->content->getCurrentWord();
        $this->assertNotEmpty($before);

        // change and assert again
        $after = $this->content
            ->setWord('new')
            ->getCurrentWord();

        $this->assertNotEmpty($after);
        $this->assertNotEquals($before, $after);
    }

    /**
     * Clean-up
     */
    public function tearDown()
    {
        $this->content = null;
        unset($this->content);
    }
}