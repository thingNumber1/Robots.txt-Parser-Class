<?php

use \t1gor\RobotsTxt\Parser;
use \t1gor\RobotsTxt\Content\EmptyContent;

/**
 * Class ParserEncodingTest
 * @group content
 * @group parser
 * @group encoding
 */
class ParserEncodingTest extends AbstractEncodingTest
{
    /**
     * @var \t1gor\RobotsTxt\Parser
     */
    protected $parser;

    /**
     * Prepare
     */
    public function setUp()
    {
        parent::setUp();
        $this->parser = new Parser();
    }

    /**
     * Clean up
     */
    public function tearDown()
    {
        $this->parser = null;
        unset($this->parser);
        parent::tearDown();
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::setContent
     * @expectedException \t1gor\RobotsTxt\Content\Exception\InvalidEncoding
     */
    public function testSetContentWithInvalidEncoding()
    {
        $this->parser->setContent(new EmptyContent(), 'bfdanbdgandagnmda');
    }
}