<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Rating implements XmlSerializable
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
     * @var Icon[]
     */
    private $icon = [];

    public function __construct(string $value, string $system = '')
    {
        $this->value = $value;
        $this->system = $system;
    }

    /**
     * @param Icon $icon
     */
    public function addIcon(Icon $icon): void
    {
        array_push($this->icon, $icon);
    }

    /**
     * @return Icon[]
     */
    public function getIcon(): array
    {
        return $this->icon;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('rating'))
            ->withAttribute('system', $this->system)
            ->withChild(new Value($this->value))
            ->withChildren($this->getIcon());
    }
}
