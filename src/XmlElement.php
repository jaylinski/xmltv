<?php

namespace XmlTv;

/**
 * This class is a writeable substitute for the `\DOMElement` class.
 */
class XmlElement implements XmlSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $value;

    /**
     * @var string[]
     */
    private $attributes = [];

    /**
     * @var XmlElement[]
     */
    private $children = [];

    public function __construct(string $name, string $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return string[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function hasAttributes(): bool
    {
        return count($this->attributes) > 0;
    }

    /**
     * @return XmlElement[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }

    /**
     * Add an attribute.
     *
     * @param string $name
     * @param string $value
     * @return XmlElement
     */
    public function withAttribute(string $name, string $value): XmlElement
    {
        if (!empty($value)) {
            $this->attributes[$name] = $value;
        }

        return $this;
    }

    /**
     * Add a child.
     *
     * @param ?XmlSerializable $child
     * @return XmlElement
     */
    public function withChild(?XmlSerializable $child): XmlElement
    {
        if ($child instanceof XmlSerializable) {
            array_push($this->children, $child->xmlSerialize());
        }

        return $this;
    }

    /**
     * Add an optional child.
     *
     * @param ?XmlSerializable $child
     * @return XmlElement
     * @deprecated Use `XmlElement::withChild()` instead.
     */
    public function withOptionalChild(?XmlSerializable $child): XmlElement
    {
        return $this->withChild($child);
    }

    /**
     * Add children.
     *
     * @param XmlSerializable[] $children
     * @return XmlElement
     */
    public function withChildren(array $children): XmlElement
    {
        foreach ($children as $child) {
            $this->withChild($child);
        }

        return $this;
    }

    public function xmlSerialize(): XmlElement
    {
        return $this;
    }
}
