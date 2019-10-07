<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class EpisodeNum implements XmlSerializable
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $system;

    /**
     * Length constructor.
     *
     * @param string $value
     * @param string $system There are two predefined numbering systems: `xmltv_ns` and `onscreen`.
     */
    public function __construct(string $value, string $system = 'onscreen')
    {
        $this->value = $value;
        $this->system = $system;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('episode-num', $this->value))
            ->withAttribute('system', $this->system);
    }
}
