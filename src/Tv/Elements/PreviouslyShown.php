<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class PreviouslyShown implements XmlSerializable
{
    public function __construct(public string $start = '', public string $channel = '')
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('previously-shown'))
            ->withAttribute('start', $this->start)
            ->withAttribute('channel', $this->channel);
    }
}
