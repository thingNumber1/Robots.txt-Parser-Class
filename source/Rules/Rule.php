<?php

namespace t1gor\RobotsTxt\Rules;

use \ArrayObject;

/**
 * Class RuleSet
 * @link http://php.net/manual/ru/class.arrayobject.php
 * @package t1gor\RobotsTxt\Rules
 */
class Rule
{
    /**
     * @var string
     */
    protected $userAgent = '*';

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $userAgent
     * @param string $key
     * @param mixed $value
     */
    public function __construct($userAgent, $key, $value)
    {
        $this->userAgent = $userAgent;
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }


}