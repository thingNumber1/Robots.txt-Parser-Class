<?php

namespace t1gor\RobotsTxt\Directive;

use \BadMethodCallException;
use \t1gor\RobotsTxt\Parser;
use \t1gor\RobotsTxt\Rules\Rule;

/**
 * Interface DirectiveInterface
 * @package t1gor\RobotsTxt\Directive
 */
abstract class AbstractDirective
{
    /**
     * @var string
     */
    protected static $name;

    /**
     * @return string
     */
    public static function getName() {
        return static::$name;
    }

    /**
     * Default simple implementation - if equals
     * @param string $word
     * @return bool
     */
    public function matches($word)
    {
        return $word === static::$name;
    }

    /**
     * By default - simply add rule
     * @todo fix
     * @param Parser $p
     * @return void
     */
    public function addRule(Parser $p)
    {
        $p->getRules()->addRule(new Rule());
    }

    /**
     * Convert robots.txt rules to php regex
     *
     * @link https://developers.google.com/webmasters/control-crawl-index/docs/robots_txt
     * @link http://stackoverflow.com/questions/3786003/str-replace-on-multibyte-strings-dangerous
     * @param string $value
     * @return string
     */
    protected static function prepareRegexRule($value)
    {
        $value = '/'.ltrim($value, '/');
        $value = str_replace(
            ['$', '?', '.', '*'],
            ['\$', '\?', '\.', '.*'],
            $value
        );

        if (mb_strlen($value) > 2 && mb_substr($value, -2) === '\$') {
            $value = mb_substr($value, 0, -2).'$';
        }

        if (mb_strrpos($value, '/') === (mb_strlen($value)-1) ||
            mb_strrpos($value, '=') === (mb_strlen($value)-1) ||
            mb_strrpos($value, '?') === (mb_strlen($value)-1)
        ) {
            $value .= '.*';
        }
        return $value;
    }
}