<?php

use \t1gor\RobotsTxt\Content\StringContent;

/**
 * Class StringContentTest
 * @group content
 */
class StringContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \t1gor\RobotsTxt\Content\StringContent::__construct
     */
    public function testConstruct()
    {
        $str = 'some-file';
        $sContent = new StringContent($str);
        $this->assertInstanceOf('\t1gor\RobotsTxt\Content\StringContent', $sContent);
        $this->assertAttributeEquals($str, 'content', $sContent);
    }

    /**
     * @covers \t1gor\RobotsTxt\Content\StringContent::read
     */
    public function testReadSuccess()
    {
        $cFile = new StringContent('some text');
        $cFile->read();

        $this->assertAttributeNotEmpty('content', $cFile);
        $this->assertAttributeGreaterThan(0, 'contentLength', $cFile);
    }
}