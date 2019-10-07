<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Review implements XmlSerializable
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $source;

    /**
     * @var string
     */
    public $reviewer;

    /**
     * @var string
     */
    public $lang;

    /**
     * Review constructor.
     *
     * @param string $value
     * @param string $type Legal values are `text` and `url`.
     * @param string $source
     * @param string $reviewer
     * @param string $lang
     */
    public function __construct(string $value, string $type, string $source = '', string $reviewer = '', string $lang = '')
    {
        $this->value = $value;
        $this->type = $type;
        $this->source = $source;
        $this->reviewer = $reviewer;
        $this->lang = $lang;
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
