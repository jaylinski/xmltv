<?php

namespace XmlTv\Tv;

abstract class LocalizedValue
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $lang;

    public function __construct(string $value, string $lang = '')
    {
        $this->value = $value;
        $this->lang = $lang;
    }
}
