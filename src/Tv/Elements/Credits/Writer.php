<?php

namespace XmlTv\Tv\Elements\Credits;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Writer implements XmlSerializable
{
    /**
     * @var string
     */
    public $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('writer', $this->value));
    }
}
