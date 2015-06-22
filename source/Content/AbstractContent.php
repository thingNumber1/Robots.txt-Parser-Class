<?php

namespace t1gor\RobotsTxt\Content;

use \Countable;
use \LengthException;
use \OutOfRangeException;

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
        // is content present?
        if ($this->content === '') {
            throw new LengthException('No content found.');
        }

        // is char index char available?
        if ($this->charIndex < 0 || $this->charIndex > $this->contentLength) {
            throw new OutOfRangeException("Char {$this->charIndex} can not be read.");
        }

        // normal flow
        return substr($this->content, $this->charIndex, 1);
    }

    /**
     * @return int
     */
    public function getCharIndex()
    {
        return $this->charIndex;
    }

    public function isNewLine()
    {
        return in_array(PHP_EOL, array(
            $this->getCurrentChar(),
            $this->getCurrentWord()
        ));
    }
}