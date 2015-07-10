<?php

use \t1gor\RobotsTxt\Parser;
use \t1gor\RobotsTxt\Content\EmptyContent;

/**
 * Class ParserTest
 * @group parser
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \t1gor\RobotsTxt\Parser::__construct
     */
    public function testConstruct()
    {
        $parser = new Parser();
        $this->assertInstanceOf('\t1gor\RobotsTxt\Parser', $parser);
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\State\StateInterface',
            'state', $parser
        );
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\Rules\RuleSet',
            'rules', $parser
        );
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::setContent
     * @covers \t1gor\RobotsTxt\Parser::getContent
     */
    public function testSetAndGetContent()
    {
        $parser = new Parser();
        $parser->setContent(new EmptyContent());

        $cInterface = '\t1gor\RobotsTxt\Content\ContentInterface';
        $this->assertAttributeInstanceOf($cInterface, 'content', $parser);
        $this->assertInstanceOf($cInterface, $parser->getContent());
        $this->assertInstanceOf($cInterface, $parser->getContent());
    }
}