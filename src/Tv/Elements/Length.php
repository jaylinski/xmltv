<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Length implements XmlSerializable
{
    /**
     * Length constructor.
     *
     * @param string $units Use one of the constants defined in `Tv\Elements\Length\Unit`.
     */
    public function __construct(public string $value, public string $units)
    {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('length', $this->value))
            ->withAttribute('units', $this->units);
    }
}
