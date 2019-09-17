<?php


namespace XmlTv\Tv\Programme;


use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class PreviouslyShown implements XmlSerializable
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $start;

    public function __construct(string $start)
    {
        $this->name = 'previously-shown';
        $this->start = $start;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement($this->name))
            ->withAttribute('start', $this->start);
    }
}
