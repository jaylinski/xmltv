<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class EpisodeNum implements XmlSerializable
{
    /**
     * Length constructor.
     *
     * @param string $system There are two predefined numbering systems: `xmltv_ns` and `onscreen`.
     */
    public function __construct(public string $value, public string $system = 'onscreen')
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('episode-num', $this->value))
            ->withAttribute('system', $this->system);
    }
}
