<?php

namespace t1gor\RobotsTxt\Directive;

use \BadMethodCallException;

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
     * By default - not implemented
     * @return string
     * @throws \BadMethodCallException
     */
    public function getValue()
    {
        throw new BadMethodCallException('Not implemented');
    }

    /**
     * Convert robots.txt rules to php regex
     *
     * @todo add mb_ support
     * @link https://developers.google.com/webmasters/control-crawl-index/docs/robots_txt
     * @link http://stackoverflow.com/questions/3786003/str-replace-on-multibyte-strings-dangerous
     * @param string $value
     * @return string
     */
    protected static function prepareRegexRule($value)
    {
        $value = '/'.ltrim($value, '/');
        $value = str_replace('$', '\$', $value);
        $value = str_replace('?', '\?', $value);
        $value = str_replace('.', '\.', $value);
        $value = str_replace('*', '.*', $value);

        if (mb_strlen($value) > 2 && mb_substr($value, -2) == '\$') {
            $value = substr($value, 0, -2).'$';
        }

        if (mb_strrpos($value, '/') == (mb_strlen($value)-1) ||
            mb_strrpos($value, '=') == (mb_strlen($value)-1) ||
            mb_strrpos($value, '?') == (mb_strlen($value)-1)
        ) {
            $value .= '.*';
        }
        return $value;
    }
}