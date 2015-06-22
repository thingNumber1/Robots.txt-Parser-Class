<?php

namespace t1gor\RobotsTxt\Content;

/**
 * Class EmptyContent
 *
 * Can be used for unit tests ?
 *
 * @package t1gor\RobotsTxt\Content
 */
final class EmptyContent extends AbstractContent implements ContentInterface
{
    /**
     * Should set internal content var and return an instance of self
     * @return $this
     */
    public function read() {
        return $this;
    }

    /**
     * @return string
     * @throws \BadMethodCallException
     */
    public function getCurrentWord() {
        throw new \BadMethodCallException('Not applicable.');
    }
}