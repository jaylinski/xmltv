<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;

class StarRating extends Rating
{
    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('star-rating'))
            ->withAttribute('system', $this->system)
            ->withChild(new Value($this->value))
            ->withChildren($this->getIcon());
    }
}
