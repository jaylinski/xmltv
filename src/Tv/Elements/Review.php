<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Review implements XmlSerializable
{
    /**
     * Review constructor.
     *
     * @param string $type Legal values are `text` and `url`.
     */
    public function __construct(
        public string $value,
        public string $type,
        public string $source = '',
        public string $reviewer = '',
        public string $lang = ''
    ) {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('review', $this->value))
            ->withAttribute('type', $this->type)
            ->withAttribute('source', $this->source)
            ->withAttribute('reviewer', $this->reviewer)
            ->withAttribute('lang', $this->lang);
    }
}
