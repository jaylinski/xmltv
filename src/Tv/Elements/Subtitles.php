<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Subtitles implements XmlSerializable
{
    /**
     * @var Language
     */
    public $language;

    /**
     * @var string
     */
    public $type;

    /**
     * Subtitles constructor.
     *
     * @param string $language
     * @param string $type Legal values are `teletext`, `onscreen` or `deaf-signed`.
     */
    public function __construct(string $language = '', string $type = '')
    {
        $this->language = $language;
        $this->type = $type;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('subtitles'))
            ->withAttribute('type', $this->type)
            ->withOptionalChild($this->language);
    }
}
