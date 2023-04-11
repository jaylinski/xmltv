<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Url implements XmlSerializable
{
    public function __construct(public string $value)
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('url', $this->value));
    }
}
