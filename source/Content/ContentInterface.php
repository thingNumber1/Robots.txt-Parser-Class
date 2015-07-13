<?php

namespace t1gor\RobotsTxt\Content;

/**
 * Interface ContentInterface
 * @package t1gor\RobotsTxt\Content
 */
interface ContentInterface
{
    /**
     * @param mixed $source
     * @return mixed
     */
    public function __construct($source);

    /**
     * Set content encoding
     * @param string $encoding
     * @return $this
     * @throws \t1gor\RobotsTxt\Content\Exception\InvalidEncoding
     */
    public function setEncoding($encoding);

    /**
     * @return string
     */
    public function getEncoding();

    /**
     * Should set internal content var and return an instance of self
     * @return $this
     */
    public function read();

    /**
     * @return int
     */
    public function count();

    /**
     * Move cursor pointer
     * @return $this
     */
    public function increment();

    /**
     * @return string
     */
    public function getCurrentChar();

    /**
     * @return string
     */
    public function getCurrentWord();

    /**
     * @param string $word
     * @return $this
     */
    public function setWord($word);

    /**
     * @return int
     */
    public function getCharIndex();

    /**
     * @return \t1gor\RobotsTxt\Content\HelperInterface
     */
    public function getHelper();
}