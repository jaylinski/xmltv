<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class NewProgramme implements XmlSerializable
{
    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('new'));
    }
}
