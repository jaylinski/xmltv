<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Subtitles implements XmlSerializable
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var Language|null
     */
    public $language;

    /**
     * Subtitles constructor.
     *
     * @param string $type Legal values are `teletext`, `onscreen` or `deaf-signed`.
     */
    public function __construct(string $type = '')
    {
        $this->type = $type;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('subtitles'))
            ->withAttribute('type', $this->type)
            ->withChild($this->language);
    }
}
