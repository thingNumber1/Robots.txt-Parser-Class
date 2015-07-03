<?php

namespace t1gor\RobotsTxt\Content;

/**
 * Class EmptyContent
 *
 * Can be used for unit tests, please do not use this class otherwise.
 * @codeCoverageIgnore
 * @package t1gor\RobotsTxt\Content
 */
final class EmptyContent extends AbstractContent
{
    /**
     * @param mixed $source
     * @return mixed
     */
    public function __construct($source = null) {
        // do nothing
    }

    /**
     * Should set internal content var and return an instance of self
     * @return $this
     */
    public function read() {
        return $this;
    }

    /**
     * @throws \BadMethodCallException
     */
    public function getCurrentWord() {
        throw new \BadMethodCallException('Not applicable.');
    }

    /**
     * @throws \BadMethodCallException
     */
    public function getCurrentChar() {
        throw new \BadMethodCallException('Not applicable.');
    }
}