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
     * @var \t1gor\RobotsTxt\Parser
     */
    protected $parser;

    /**
     * Create instance
     */
    public function setUp()
    {
        $this->parser = new Parser();
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
     * @covers \t1gor\RobotsTxt\Parser::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('\t1gor\RobotsTxt\Parser', $this->parser);
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\State\StateInterface',
            'state', $this->parser
        );
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\Rules\RuleSet',
            'rules', $this->parser
        );
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::setContent
     * @covers \t1gor\RobotsTxt\Parser::getContent
     */
    public function testSetAndGetContent()
    {
        $this->parser->setContent(new EmptyContent());
        $cInterface = '\t1gor\RobotsTxt\Content\ContentInterface';
        $this->assertAttributeInstanceOf($cInterface, 'content', $this->parser);
        $this->assertInstanceOf($cInterface, $this->parser->getContent());
    }

    /**
     * @param string $encoding
     * @covers \t1gor\RobotsTxt\Parser::setContent
     * @dataProvider validEncodingProvider
     */
    public function testSetContentWithEncoding($encoding)
    {
        $this->parser->setContent(new EmptyContent(), $encoding);
        $this->assertEquals($encoding, $this->parser->getContent()->getEncoding());
    }

    /**
     * @covers \t1gor\RobotsTxt\Parser::setContent
     * @expectedException \t1gor\RobotsTxt\Content\Exception\InvalidEncoding
     */
    public function testSetContentWithInvalidEncoding()
    {
        $this->parser->setContent(new EmptyContent(), 'bfdanbdgandagnmda');
    }

    /**
     * @return array
     */
    public function validEncodingProvider()
    {
        return [
            ['UTF-8'],
            ['ISO-8859-1'],
            ['Windows-1251'],
            ['8bit'],
            ['HZ'],
            ['HTML-ENTITIES'],
            ['UTF-32']
        ];
    }
}