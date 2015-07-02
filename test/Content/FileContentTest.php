<?php

use \t1gor\RobotsTxt\Content\File;

/**
 * Class FileContentTest
 * @group content
 */
class FileContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \t1gor\RobotsTxt\Content\File::__construct
     */
    public function testConstruct()
    {
        $filePath = 'some-file';
        $cFile = new File($filePath);
        $this->assertInstanceOf('\t1gor\RobotsTxt\Content\File', $cFile);
        $this->assertAttributeEquals($filePath, 'filePath', $cFile);
    }

    /**
     * @covers t1gor\RobotsTxt\Content\File::read
     * @expectedException \t1gor\RobotsTxt\Content\File\Exception\NotFound
     */
    public function testReadFileNotFound()
    {
        $cFile = new File('non-existing-file');
        $cFile->read();
    }

    /**
     * @covers t1gor\RobotsTxt\Content\File::read
     * @expectedException \t1gor\RobotsTxt\Content\File\Exception\NotReadable
     */
    public function testReadNotReadable()
    {
        $cFile = new File(realpath(__DIR__.'/../_data/non.readable.txt'));
        $cFile->read();
    }

    /**
     * @covers t1gor\RobotsTxt\Content\File::read
     */
    public function testReadSuccess()
    {
        $cFile = new File(realpath(__DIR__.'/../_data/google.robots.txt'));
        $cFile->read();

        $this->assertAttributeNotEmpty('content', $cFile);
        $this->assertAttributeGreaterThan(0, 'contentLength', $cFile);
    }
}