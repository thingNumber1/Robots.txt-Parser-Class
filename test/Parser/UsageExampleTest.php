<?php

use \t1gor\RobotsTxt\Parser;
use \t1gor\RobotsTxt\Content\FileContent;

/**
 * Class UsageExampleTest
 * @group usage
 */
class UsageExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalUseCase()
    {
        $file = realpath(__DIR__.'/../_data/google.robots.txt');
        $parser = new Parser();
        $parser->setContent(new FileContent($file));

        $parser->parse();
    }
}