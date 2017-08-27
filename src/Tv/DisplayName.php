<?php

namespace XmlTv\Tv;

class DisplayName
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $language;

    /**
     * DisplayName constructor.
     *
     * @param string $name
     * @param string $language
     */
    public function __construct(string $name, string $language = '')
    {
        $this->name = $name;
        $this->language = $language;
    }
}
