<?php

namespace t1gor\RobotsTxt\Content;

use t1gor\RobotsTxt\Directive\DirectiveInterface;

/**
 * Interface HelperInterface
 * @package t1gor\RobotsTxt\Content
 */
interface HelperInterface
{
    /**
     * @param ContentInterface $content
     */
    public function __construct(ContentInterface $content);

    /**
     * @return DirectiveInterface
     */
    public function getDirectiveFromCurrentWord();

    /**
     * @return $this
     */
    public function removeLastCharFromCurrentWord();

    /**
     * @return $this
     */
    public function setWordToLastChar();

    /**
     * @return bool
     */
    public function isNewLine();

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
}