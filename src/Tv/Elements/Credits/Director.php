<?php

namespace XmlTv\Tv\Elements\Credits;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Director implements XmlSerializable
{
    public function __construct(public string $value)
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('director', $this->value));
    }
}
