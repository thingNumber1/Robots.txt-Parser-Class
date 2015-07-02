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
    const CHAR_SPACE = '\s';
    const CHAR_SHARP = '#';

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
     * @return bool
     */
    public function isSpace() {
        return ($this->content->getCurrentChar() === static::CHAR_SPACE);
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
        $dName = mb_strtolower(trim($this->content->getCurrentWord()));
        return new $dName();
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