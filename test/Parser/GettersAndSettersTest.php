<?php

use \t1gor\RobotsTxt\Parser;
use \t1gor\RobotsTxt\State\SkipLine;
use \t1gor\RobotsTxt\Content\EmptyContent;

/**
 * Class GettersAndSettersTest
 * @group parser
 */
class GettersAndSettersTest extends \PHPUnit_Framework_TestCase
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
        $this->parser = new Parser();
        $this->parser->setContent(new EmptyContent());
    }

    /**
     * Clean-up
     */
    public function tearDown()
    {
        $this->parser = null;
        unset($this->parser);
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::setState
     */
    public function testSetState()
    {
        $state = new SkipLine();
        $this->parser->setState($state);

        $this->assertAttributeInstanceOf('\t1gor\RobotsTxt\State\SkipLine', 'state', $this->parser);
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::setState
     */
    public function testSetStateChainable()
    {
        $state = new SkipLine();
        $result = $this->parser->setState($state);
        $this->assertInstanceOf('\t1gor\RobotsTxt\Parser', $result);
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::getState
     */
    public function testGetState()
    {
        // ZeroPoint by default
        $this->assertInstanceOf('\t1gor\RobotsTxt\State\ZeroPoint', $this->parser->getState());

        $state = new SkipLine();
        $newState = $this->parser->setState($state)->getState();
        $this->assertEquals($state, $newState);
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::getRules
     */
    public function testGetRuleSet()
    {
        $this->assertInstanceOf('\t1gor\RobotsTxt\Rules\RuleSet', $this->parser->getRules());
    }
}