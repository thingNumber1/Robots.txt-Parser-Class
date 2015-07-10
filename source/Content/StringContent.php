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
     * @param string $source
     * @return mixed
     */
    public function __construct($source = '') {
        $this->content = $source;
    }

    /**
     * Should set internal content var and return an instance of self
     * @return $this
     */
    public function read() {
        $this->contentLength = mb_strlen($this->content, $this->encoding);
        $this->increment();
        return $this;
    }
}