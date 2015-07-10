<?php

use \t1gor\RobotsTxt\Content\Helper;
use \t1gor\RobotsTxt\Content\StringContent;

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
        $sContent = new StringContent('some string content');
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\Content\ContentInterface',
            'content', $sContent->getHelper()
        );
        $this->assertAttributeInstanceOf(
            '\t1gor\RobotsTxt\Content\StringContent',
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
        $sContent = new StringContent($string);
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
        $sContent = new StringContent($string);
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
        $sContent = new StringContent($string);
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
        $sContent = new StringContent($string);
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
        $sContent = new StringContent();
        $sContent->setWord($word)->read();

        $iterface = '\t1gor\RobotsTxt\Directive\DirectiveInterface';
        $directive = $sContent->getHelper()->getDirectiveFromCurrentWord();
        $this->assertInstanceOf($class, $directive);
        $this->assertInstanceOf($iterface, $directive);
    }

    /**
     * @param string $word
     * @dataProvider substructionWordsProvider
     * @covers \t1gor\RobotsTxt\Content\Helper::removeLastCharFromCurrentWord
     */
    public function testRemoveLastCharFromCurrentWord($word)
    {
        $subWord = mb_substr($word, 0, -1);

        // prepare content
        $sContent = new StringContent();
        $sContent
            ->setWord($word)
            ->read()
            ->getHelper()
            ->removeLastCharFromCurrentWord();

        $this->assertEquals($subWord, $sContent->getCurrentWord());
    }

    /**
     * @param string $word
     * @dataProvider substructionWordsProvider
     * @covers \t1gor\RobotsTxt\Content\Helper::setWordToLastChar
     */
    public function testSetWordToLastChar($word)
    {
        $lastChar = mb_substr($word, -1);

        // prepare content
        $sContent = new StringContent();
        $sContent
            ->setWord($word)
            ->read()
            ->getHelper()
            ->setWordToLastChar();

        $this->assertEquals($lastChar, $sContent->getCurrentWord());
    }

    /**
     * Use different languages for mb_
     * @return array
     */
    public function substructionWordsProvider()
    {
        return [
            [ 'word' ],
            [ 'слово' ],
            [ 'Wort' ],
            [ 'מילה' ],
        ];
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