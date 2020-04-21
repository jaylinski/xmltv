<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Length implements XmlSerializable
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $units;

    /**
     * Length constructor.
     *
     * @param string $value
     * @param string $units Use one of the constants defined in `Tv\Elements\Length\Unit`.
     */
    public function __construct(string $value, string $units)
    {
        $this->value = $value;
        $this->units = $units;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('length', $this->value))
            ->withAttribute('units', $this->units);
    }
}
