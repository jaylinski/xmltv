<?php

namespace XmlTv\Tv\Elements\Credits;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Actor implements XmlSerializable
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $role;

    public function __construct(string $value, string $role = '')
    {
        $this->value = $value;
        $this->role = $role;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('actor', $this->value))
            ->withAttribute('role', $this->role);
    }
}
