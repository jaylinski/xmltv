<?php

namespace XmlTv\Tv;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

abstract class LocalizedValue implements XmlSerializable
{
    /**
     * @var string
     */
    public $name;

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

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement($this->name, $this->value))
            ->withAttribute('lang', $this->lang);
    }
}
