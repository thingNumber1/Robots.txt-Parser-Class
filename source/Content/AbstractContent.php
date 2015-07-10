<?php

namespace t1gor\RobotsTxt\Content;

use \Countable;
use \t1gor\RobotsTxt\Content\Helper;
use \t1gor\RobotsTxt\Content\Exception\InvalidEncoding;

/**
 * Class AbstractContent
 * @package t1gor\RobotsTxt\Parser
 */
abstract class AbstractContent implements Countable, ContentInterface
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
     * @throws \t1gor\RobotsTxt\Content\Exception\InvalidEncoding
     */
    public function setEncoding($encoding = self::DEFAULT_ENCODING)
    {
        // set MB encoding
        if (false === mb_internal_encoding($encoding)) {
            throw new InvalidEncoding('Encoding "'.$encoding.'" is not supported by php.');
        }

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
     * @return int
     */
    public function count()
    {
        return (int) $this->contentLength;
    }

    /**
     * @return string
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
     * Move cursor pointer
     * @return $this
     */
    protected function increment()
    {
        $this->char = mb_strtolower(mb_substr($this->content, $this->charIndex, 1));
        $this->word .= $this->char;
        $this->word = trim($this->word);
        $this->charIndex++;
        return $this;
    }

    /**
     * @param string $word
     * @return $this
     */
    public function setWord($word)
    {
        $this->word = $word;
        return $this;
    }

    /**
     * @return \t1gor\RobotsTxt\Content\Helper
     */
    public function getHelper()
    {
        return new Helper($this);
    }
}