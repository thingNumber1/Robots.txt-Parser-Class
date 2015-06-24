<?php

namespace t1gor\RobotsTxt\Content;

use t1gor\RobotsTxt\Directive\DirectiveInterface;

/**
 * Interface ContentInterface
 * @package t1gor\RobotsTxt\Content
 */
interface ContentInterface
{
    /**
     * Set content encoding
     * @param string $encoding
     * @return $this
     */
    public function setEncoding($encoding);

    /**
     * Get current content encoding
     * @return string
     */
    public function getEncoding();

    /**
     * Should set internal content var and return an instance of self
     * @return $this
     */
    public function read();

    /**
     * @return string
     */
    public function getCurrentChar();

    /**
     * @return string
     */
    public function getCurrentWord();

    /**
     * @return int
     */
    public function getCharIndex();

    /**
     * @return int
     */
    public function length();

    /**
     * @return bool
     */
    public function isNewLine();

    /**
     * Move cursor pointer
     * @return $this
     */
    public function increment();

    /**
     * Set current word to ''.
     * @return $this
     */
    public function flushWord();

    /**
     * @return DirectiveInterface
     */
    public function getDirectiveFromCurrentWord();

    /**
     * Key : value pair separator signal
     * @return bool
     */
    public function isLineSeparator();

    /**
     * @return bool
     */
    public function isSpace();

    /**
     * @return bool
     */
    public function isSharp();

    /**
     * @return $this
     */
    public function removeLastCharFromCurrentWord();

    /**
     * @return $this
     */
    public function setWordToLastChar();
}