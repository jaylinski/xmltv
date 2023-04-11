<?php

namespace XmlTv;

/**
 * This class is a writeable substitute for the `\DOMElement` class.
 */
class XmlElement implements XmlSerializable
{
    /**
     * @var array<string, string>
     */
    private array $attributes = [];

    /**
     * @var XmlElement[]
     */
    private array $children = [];

    public function __construct(private string $name, private ?string $value = null)
    {
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
     * @return array<string, string>
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
     */
    public function withChild(?XmlSerializable $child): XmlElement
    {
        if ($child instanceof XmlSerializable) {
            array_push($this->children, $child->xmlSerialize());
        }

        return $this;
    }

    /**
     * Add children.
     *
     * @param XmlSerializable[] $children
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
