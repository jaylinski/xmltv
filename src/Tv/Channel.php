<?php

namespace XmlTv\Tv;

use XmlTv\Tv\Elements\DisplayName;
use XmlTv\Tv\Elements\Icon;
use XmlTv\Tv\Elements\Url;
use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Channel implements XmlSerializable
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var DisplayName[]
     */
    private $displayName = [];

    /**
     * @var Icon[]
     */
    private $icon = [];

    /**
     * @var Url[]
     */
    private $url = [];

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Add a display name.
     *
     * @param DisplayName $displayName
     */
    public function addDisplayName(DisplayName $displayName): void
    {
        array_push($this->displayName, $displayName);
    }

    /**
     * Get all display names.
     *
     * @return DisplayName[]
     */
    public function getDisplayName(): array
    {
        return $this->displayName;
    }

    /**
     * Add an icon.
     *
     * @param Icon $icon
     */
    public function addIcon(Icon $icon): void
    {
        array_push($this->icon, $icon);
    }

    /**
     * Add a url.
     *
     * @param Url $url
     */
    public function addUrl(Url $url): void
    {
        array_push($this->url, $url);
    }

    /**
     * Get all urls.
     *
     * @return Url[]
     */
    public function getUrl(): array
    {
        return $this->url;
    }

    /**
     * Get all icons.
     *
     * @return Icon[]
     */
    public function getIcon(): array
    {
        return $this->icon;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('channel'))
            ->withAttribute('id', $this->id)
            ->withChildren($this->getDisplayName())
            ->withChildren($this->getIcon())
            ->withChildren($this->getUrl());
    }
}
