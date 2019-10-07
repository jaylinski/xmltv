<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Icon implements XmlSerializable
{
    /**
     * @var string
     */
    public $src;

    /**
     * @var string
     */
    public $width;

    /**
     * @var string
     */
    public $height;

    public function __construct(string $src, string $width = '', string $height = '')
    {
        $this->src = $src;
        $this->width = $width;
        $this->height = $height;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('icon'))
            ->withAttribute('src', $this->src)
            ->withAttribute('width', $this->width)
            ->withAttribute('height', $this->height);
    }
}
