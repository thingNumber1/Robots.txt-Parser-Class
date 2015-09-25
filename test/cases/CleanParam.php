<?php
/**
 * @group clean-param
 */
class CleanParamTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @link https://help.yandex.ru/webmaster/controlling-robot/robots-txt.xml#clean-param
	 *
	 * @dataProvider generateDataForTest
	 * @covers RobotsTxtParser::isDisallowed
	 * @covers RobotsTxtParser::checkRule
	 * @param string $content
	 * @param string $urls
	 */
	public function testCleanParam($content, $urls)
	{
		// init parser
		$parser = new RobotsTxtParser($content);
		$rules = $parser->getRules();

		$this->assertNotEmpty($rules);
		$this->assertNotEmpty($rules['clean-param']);
		$this->assertInternalType('array', $rules['clean-param']);
	}

	/**
	 * Generate test case data
	 * @return array
	 */
	public function generateDataForTest()
	{
		return array(
			// single param
			array(
				"
					User-Agent: *
					Disallow:
					Clean-param: s /forum/showthread.php
				",
				array(
					'/forum/showthread.php?s=681498b9648949605&t=8243',
					'/forum/showthread.php?s=1e71c4427317a117a&t=8243'
				)
			),
			// several params
			array(
				"
					User-Agent: Yandex
					Disallow:
					Clean-param: s&ref /forum*/showthread.php
				",
				array(
					'/forum_old/showthread.php?s=681498605&t=8243&ref=1311',
					'/forum_new/showthread.php?s=1e71c417a&t=8243&ref=9896',
				)
			),
		);
	}
	}
