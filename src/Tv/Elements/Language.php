<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Language implements XmlSerializable
{
    public function __construct(public string $value, public string $lang = '')
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('language', $this->value))
            ->withAttribute('lang', $this->lang);
    }
}
