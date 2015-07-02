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
        $h = $sContent->getHelper();
        $this->assertAttributeInstanceOf('\t1gor\RobotsTxt\Content\ContentInterface', 'content', $h);
        $this->assertAttributeInstanceOf('\t1gor\RobotsTxt\Content\String', 'content', $h);
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
        $h = $sContent->getHelper();
        $this->assertEquals($result, $h->isNewLine());
    }

    /**
     * @return array
     */
    public function isNewLineStringsProvider()
    {
        return [
            [ PHP_EOL.' bfsdbafds ', true ],
            [ ' bfsdbafds ', false ],
            [ "\n bfsdbafds ", true ],
        ];
    }
}