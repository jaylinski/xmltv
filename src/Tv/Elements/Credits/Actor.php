<?php

namespace XmlTv\Tv\Elements\Credits;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Actor implements XmlSerializable
{
    public function __construct(public string $value, public string $role = '')
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('actor', $this->value))
            ->withAttribute('role', $this->role);
    }
}
