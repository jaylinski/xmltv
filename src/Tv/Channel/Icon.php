<?php

namespace XmlTv\Tv\Channel;

class Icon
{
    /**
     * @var string
     */
    public $src;

    /**
     * @var string
     */
    public $width;

    /**
     * @var string
     */
    public $height;

    public function __construct(string $src, string $width = '', string $height = '')
    {
        $this->src = $src;
        $this->width = $width;
        $this->height = $height;
    }
}
