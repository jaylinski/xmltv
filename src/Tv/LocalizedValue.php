<?php

namespace XmlTv\Tv;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

abstract class LocalizedValue implements XmlSerializable
{
    protected string $name = '';

    public function __construct(public string $value, public string $lang = '')
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement($this->name, $this->value))
            ->withAttribute('lang', $this->lang);
    }
}
