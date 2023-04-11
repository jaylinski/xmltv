<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Subtitles implements XmlSerializable
{
    public ?Language $language = null;

    /**
     * Subtitles constructor.
     *
     * @param string $type Legal values are `teletext`, `onscreen` or `deaf-signed`.
     */
    public function __construct(public string $type = '')
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('subtitles'))
            ->withAttribute('type', $this->type)
            ->withChild($this->language);
    }
}
