<?php

namespace XmlTv\Tv\Elements\Credits;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Presenter implements XmlSerializable
{
    public function __construct(public string $value)
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('presenter', $this->value));
    }
}
