<?php

/**
 * Class AbstractEncodingTest
 * @group content
 * @group parser
 */
class AbstractEncodingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Error reporting level
     * @var int
     */
    protected $errorLevel;

    /**
     * Prepare
     */
    public function setUp()
    {
        // remember
        $this->errorLevel = error_reporting();

        // set to none to suppress error
        error_reporting(0);
    }

    /**
     * Restore error level
     */
    public function tearDown()
    {
        error_reporting($this->errorLevel);
    }
}