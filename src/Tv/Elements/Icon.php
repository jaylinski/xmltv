<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Icon implements XmlSerializable
{
    public function __construct(public string $src, public string $width = '', public string $height = '')
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('icon'))
            ->withAttribute('src', $this->src)
            ->withAttribute('width', $this->width)
            ->withAttribute('height', $this->height);
    }
}
