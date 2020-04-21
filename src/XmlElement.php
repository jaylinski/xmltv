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
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $children = [];

    /**
     * XmlElement constructor.
     *
     * @param string $name
     * @param string|null $value
     */
    public function __construct(string $name, string $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return bool
     */
    public function hasAttributes(): bool
    {
        return count($this->attributes) > 0;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }

    /**
     * Add an attribute.
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function withAttribute(string $name, string $value)
    {
        if (!empty($value)) {
            $this->attributes[$name] = $value;
        }

        return $this;
    }

    /**
     * Add child.
     *
     * @param XmlSerializable $child
     * @return $this
     */
    public function withChild(XmlSerializable $child)
    {
        array_push($this->children, $child->xmlSerialize());

        return $this;
    }

    /**
     * Add optional child.
     *
     * @param XmlSerializable|mixed $child
     * @return $this
     */
    public function withOptionalChild($child)
    {
        if ($child instanceof XmlSerializable) {
            array_push($this->children, $child->xmlSerialize());
        } elseif (is_object($child)) {
            trigger_error('Could not serialize ' . get_class($child), E_USER_WARNING);
        }

        return $this;
    }

    /**
     * Add children.
     *
     * @param XmlSerializable[] $children
     * @return $this
     */
    public function withChildren(array $children)
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
