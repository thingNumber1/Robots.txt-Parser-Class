<?php

use \t1gor\RobotsTxt\Content\EmptyContent;

/**
 * Class AbstractContentTest
 * @group content
 */
abstract class AbstractContentTest extends \PHPUnit_Framework_TestCase
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
        $this->content = new EmptyContent();
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