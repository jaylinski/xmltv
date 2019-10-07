<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Language implements XmlSerializable
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $lang;

    public function __construct(string $value, string $lang = '')
    {
        $this->value = $value;
        $this->lang = $lang;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('language', $this->value))
            ->withAttribute('lang', $this->lang);
    }
}
