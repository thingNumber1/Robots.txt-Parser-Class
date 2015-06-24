<?php

namespace t1gor\RobotsTxt\Content;

use \Countable;
use \LengthException;
use \OutOfRangeException;
use \t1gor\RobotsTxt\Directive\DirectiveInterface;

/**
 * Class AbstractContent
 * @package t1gor\RobotsTxt\Parser
 */
abstract class AbstractContent implements Countable
{
    /**
     * default encoding
     * @var string
     */
    const DEFAULT_ENCODING = 'UTF-8';

    /**
     * @var string
     */
    protected $encoding = self::DEFAULT_ENCODING;

    /**
     * @var string
     */
    protected $content = '';

    /**
     * Should be calculated on read()
     * @var int
     */
    protected $contentLength = 0;

    /**
     * Cursor
     * @var int
     */
    protected $charIndex = 0;

    /**
     * @var string
     */
    protected $word = '';

    /**
     * @var string
     */
    protected $char = '';

    /**
     * @param string $encoding
     * @return $this
     */
    public function setEncoding($encoding = self::DEFAULT_ENCODING)
    {
        // set MB encoding
        mb_internal_encoding($encoding);

        // save for reference
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Alias for count
     * @return int
     */
    public function length()
    {
        return $this->count();
    }

    /**
     * @return int
     */
    public function count()
    {
        return (int) $this->contentLength;
    }

    /**
     * @return string
     * @throws \LengthException
     * @throws \OutOfRangeException
     */
    public function getCurrentChar() {
        return $this->char;
    }

    /**
     * @return string
     */
    public function getCurrentWord() {
        return $this->word;
    }

    /**
     * @return int
     */
    public function getCharIndex() {
        return (int) $this->charIndex;
    }

    /**
     * @return bool
     * @throws \LogicException
     */
    public function isNewLine() {
        return array_key_exists(PHP_EOL, array($this->word, $this->char));
    }

    /**
     * Key : value pair separator signal
     * @return bool
     */
    public function isLineSeparator() {
        return ($this->char === ':');
    }

    /**
     * @return bool
     */
    public function isSpace() {
        return ($this->char === '\s');
    }

    /**
     * @return bool
     */
    public function isSharp() {
        return ($this->char === '#');
    }

    /**
     * Move cursor pointer
     * @return $this
     */
    public function increment()
    {
        $this->char = mb_strtolower(mb_substr($this->content, $this->charIndex, 1));
        $this->word .= $this->char;
        $this->word = trim($this->word);
        $this->charIndex++;
        return $this;
    }

    /**
     * @return $this
     */
    public function flushWord()
    {
        $this->word = '';
        return $this;
    }

    /**
     * @return DirectiveInterface
     */
    public function getDirectiveFromCurrentWord()
    {
        $dName = mb_strtolower(trim($this->getCurrentWord()));
        return new $dName();
    }

    /**
     * Simply remove last char
     * @return $this
     */
    public function removeLastCharFromCurrentWord()
    {
        $this->word = mb_substr($this->word, 0, -1);
        return $this;
    }

    /**
     * @return $this
     */
    public function setWordToLastChar()
    {
        $this->word = mb_substr($this->word, -1);
        return $this;
    }
}