<?php

namespace t1gor\RobotsTxt\Content;

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
}