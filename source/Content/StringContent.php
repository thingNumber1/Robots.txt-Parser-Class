<?php

namespace t1gor\RobotsTxt\Content;

/**
 * Class String
 *
 * Reads content from a string.
 *
 * @package t1gor\RobotsTxt\Content
 */
final class StringContent extends AbstractContent
{
    /**
     * @var string
     */
    protected $string = '';

    /**
     * @param string $source
     * @return mixed
     */
    public function __construct($source = '') {
        $this->string = $source;
    }

    /**
     * Should set internal content var and return an instance of self
     * @return $this
     */
    public function read() {
        $this->content = $this->string;
        $this->contentLength = mb_strlen($this->content, $this->encoding);
        $this->increment();
        return $this;
    }
}