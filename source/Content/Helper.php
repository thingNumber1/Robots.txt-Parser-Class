<?php

namespace t1gor\RobotsTxt\Content;

use t1gor\RobotsTxt\Directive\DirectiveInterface;

/**
 * Class Helper
 *
 * The idea of this is to make AbstractContent public API shorter a few methods.
 *
 * @package t1gor\RobotsTxt\Content
 */
class Helper implements HelperInterface
{
    /**
     * @var \t1gor\RobotsTxt\Content\ContentInterface
     */
    protected $content = null;

    const CHAR_LINE_SEPARATOR = ':';
    const CHAR_SHARP = '#';

    /**
     * To avoid parsing class name - just use the map
     * @var array
     */
    protected static $directiveClassMap = [
        'allow' => 'Allow',
        'disallow' =>'Disallow',
        'host' => 'Host',
        'sitemap' => 'Sitemap',
        'crawl-delay' => 'CrawlDelay',
        'user-agent' => 'UserAgent'
    ];

    /**
     * @param ContentInterface $content
     */
    public function __construct(ContentInterface $content) {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function isNewLine() {
        return array_key_exists(PHP_EOL, array_flip([
            $this->content->getCurrentWord(),
            $this->content->getCurrentChar()
        ]));
    }

    /**
     * Key : value pair separator signal
     * @return bool
     */
    public function isLineSeparator() {
        return ($this->content->getCurrentChar() === static::CHAR_LINE_SEPARATOR);
    }

    /**
     * @link http://php.net/manual/en/function.ctype-space.php
     * @return bool
     */
    public function isSpace() {
        return ctype_space($this->content->getCurrentChar());
    }

    /**
     * @return bool
     */
    public function isSharp() {
        return ($this->content->getCurrentChar() === static::CHAR_SHARP);
    }

    /**
     * @return DirectiveInterface
     */
    public function getDirectiveFromCurrentWord()
    {
        $nameSpace = '\t1gor\RobotsTxt\Directive\\';
        $dName = mb_strtolower(trim($this->content->getCurrentWord()));
        $className = $nameSpace.static::$directiveClassMap[ $dName ];
        return new $className();
    }

    /**
     * Simply remove last char
     * @return $this
     */
    public function removeLastCharFromCurrentWord()
    {
        $cWord = $this->content->getCurrentWord();
        $this->content->setWord(mb_substr($cWord, 0, -1));
        return $this;
    }

    /**
     * @return $this
     */
    public function setWordToLastChar()
    {
        $cWord = $this->content->getCurrentWord();
        $this->content->setWord(mb_substr($cWord, -1));
        return $this;
    }
}