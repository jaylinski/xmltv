<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Rating implements XmlSerializable
{
    /**
     * @var Icon[]
     */
    private array $icon = [];

    public function __construct(public string $value, public string $system = '')
    {
    }

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
