<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class PreviouslyShown implements XmlSerializable
{
    /**
     * @var string
     */
    public $start;

    /**
     * @var string
     */
    public $channel;

    public function __construct(string $start = '', string $channel = '')
    {
        $this->start = $start;
        $this->channel = $channel;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('previously-shown'))
            ->withAttribute('start', $this->start)
            ->withAttribute('channel', $this->channel);
    }
}
