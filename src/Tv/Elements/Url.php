<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Url implements XmlSerializable
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
        return (new XmlElement('url', $this->value));
    }
}
