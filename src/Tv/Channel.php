<?php

namespace XmlTv\Tv;

class Channel
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var DisplayName[]
     */
    private $displayNames = [];

    /**
     * @var
     */
    public $icon;

    /**
     * Channel constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Add a display name.
     *
     * @param DisplayName $displayName
     */
    public function addDisplayName(DisplayName $displayName)
    {
        array_push($this->displayNames, $displayName);
    }

    /**
     * Get all display names.
     *
     * @return array
     */
    public function getDisplayNames()
    {
        return $this->displayNames;
    }
}
