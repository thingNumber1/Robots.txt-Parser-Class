<?php

use \t1gor\RobotsTxt\Content\Helper;
use \t1gor\RobotsTxt\Content\String;

/**
 * Class HelperTest
 * @group content
 */
class HelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \t1gor\RobotsTxt\Content\Helper::__construct
     */
    public function testConstruct()
    {
        $sContent = new String('some string content');
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\Content\ContentInterface',
            'content', $sContent->getHelper()
        );
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\Content\String',
            'content', $sContent->getHelper()
        );
    }

    /**
     * @param string $string
     * @param bool $result
     * @dataProvider isNewLineStringsProvider
     * @covers \t1gor\RobotsTxt\Content\Helper::isNewLine
     */
    public function testIsNewLine($string, $result = false)
    {
        // prepare content
        $sContent = new String($string);
        $sContent->read();

        // build helper
        $this->assertEquals($result, $sContent->getHelper()->isNewLine());
    }

    /**
     * @param string $string
     * @param bool $result
     * @dataProvider isLineSeparatorStringsProvider
     * @covers \t1gor\RobotsTxt\Content\Helper::isLineSeparator
     */
    public function testIsLineSeparator($string, $result = false)
    {
        // prepare content
        $sContent = new String($string);
        $sContent->read();

        // build helper
        $this->assertEquals($result, $sContent->getHelper()->isLineSeparator());
    }

    /**
     * @param string $string
     * @param bool $result
     * @dataProvider isSpaceStringsProvider
     * @covers \t1gor\RobotsTxt\Content\Helper::isSpace
     */
    public function testIsSpace($string, $result = false)
    {
        // prepare content
        $sContent = new String($string);
        $sContent->read();

        // build helper
        $this->assertEquals($result, $sContent->getHelper()->isSpace());
    }

    /**
     * @param string $string
     * @param bool $result
     * @dataProvider isSharpStringsProvider
     * @covers \t1gor\RobotsTxt\Content\Helper::isSharp
     */
    public function testIsCharp($string, $result = false)
    {
        // prepare content
        $sContent = new String($string);
        $sContent->read();

        // build helper
        $this->assertEquals($result, $sContent->getHelper()->isSharp());
    }

    /**
     * @param string $word
     * @param string $class
     * @dataProvider directivesContentProvider
     * @covers \t1gor\RobotsTxt\Content\Helper::getDirectiveFromCurrentWord
     */
    public function testGetDirectiveFromCurrentWord($word, $class)
    {
        // prepare content
        $sContent = new String('');
        $sContent->setWord($word)->read();

        $iterface = '\t1gor\RobotsTxt\Directive\DirectiveInterface';
        $directive = $sContent->getHelper()->getDirectiveFromCurrentWord();
        $this->assertInstanceOf($class, $directive);
        $this->assertInstanceOf($iterface, $directive);
    }

    /**
     * @return array
     */
    public function directivesContentProvider()
    {
        return [
            [ 'Allow', '\t1gor\RobotsTxt\Directive\Allow' ],
            [ 'Disallow', '\t1gor\RobotsTxt\Directive\Disallow' ],
            [ 'Host', '\t1gor\RobotsTxt\Directive\Host' ],
            [ 'Sitemap', '\t1gor\RobotsTxt\Directive\Sitemap' ],
            [ 'crawl-delay', '\t1gor\RobotsTxt\Directive\CrawlDelay' ],
            [ 'user-agent', '\t1gor\RobotsTxt\Directive\UserAgent' ],
        ];
    }

    /**
     * @return array
     */
    public function isSharpStringsProvider()
    {
        return [
            [ '# bfsdbafds ', true ],
            [ Helper::CHAR_SHARP, true ],
            [ 'some#text' ],
            [ 'bfsdbafds ' ],
        ];
    }

    /**
     * @return array
     */
    public function isSpaceStringsProvider()
    {
        return [
            [ ' bfsdbafds ', true ],
            [ "\tsome text", true ],
            [ "\rsome text", true ],
            [ 'bfsdbafds ' ],
        ];
    }

    /**
     * @return array
     */
    public function isLineSeparatorStringsProvider()
    {
        return [
            [ ': bfsdbafds ', true ],
            [ Helper::CHAR_LINE_SEPARATOR, true ],
            [ ' : bfsdbafds ' ],
            [ ' bfsdbafds ' ],
        ];
    }

    /**
     * @return array
     */
    public function isNewLineStringsProvider()
    {
        return [
            [ PHP_EOL.' bfsdbafds ', true ],
            [ "\n bfsdbafds ", true ],
            [ "\n bfsdbafds ", true ],
            [ ' bfsdbafds ' ],
        ];
    }
}