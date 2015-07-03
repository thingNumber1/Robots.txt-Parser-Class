<?php

use \t1gor\RobotsTxt\Content\FileContent;

/**
 * Class FileContentTest
 * @group content
 */
class FileContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \t1gor\RobotsTxt\Content\FileContent::__construct
     */
    public function testConstruct()
    {
        $filePath = 'some-file';
        $cFile = new FileContent($filePath);
        $this->assertInstanceOf('\t1gor\RobotsTxt\Content\FileContent', $cFile);
        $this->assertAttributeEquals($filePath, 'filePath', $cFile);
    }

    /**
     * @covers t1gor\RobotsTxt\Content\FileContent::read
     * @expectedException \t1gor\RobotsTxt\Content\File\Exception\NotFound
     */
    public function testReadFileNotFound()
    {
        $cFile = new FileContent('non-existing-file');
        $cFile->read();
    }

    /**
     * @covers t1gor\RobotsTxt\Content\FileContent::read
     * @expectedException \t1gor\RobotsTxt\Content\File\Exception\NotReadable
     */
    public function testReadNotReadable()
    {
        $cFile = new FileContent(realpath(__DIR__.'/../_data/non.readable.txt'));
        $cFile->read();
    }

    /**
     * @covers t1gor\RobotsTxt\Content\FileContent::read
     */
    public function testReadSuccess()
    {
        $cFile = new FileContent(realpath(__DIR__.'/../_data/google.robots.txt'));
        $cFile->read();

        $this->assertAttributeNotEmpty('content', $cFile);
        $this->assertAttributeGreaterThan(0, 'contentLength', $cFile);
    }
}