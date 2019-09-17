<?php

namespace XmlTv\Tv\Programme;

use XmlTv\Tv\LocalizedValue;
use XmlTv\XmlElement;

class EpisodeNum extends LocalizedValue
{
    public $name = 'episode-num';

    /**
     * @var string
     */
    public $system;

    public function __construct(string $value, string $system = 'xml_ns')
    {
        $this->value = $value;
        $this->system = $system;
    }


    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement($this->name, $this->value))
            ->withAttribute('system', $this->system);
    }
}
