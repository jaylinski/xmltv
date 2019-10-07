<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Video implements XmlSerializable
{
    /**
     * @var string
     */
    public $present;

    /**
     * @var string
     */
    public $colour;

    /**
     * @var string
     */
    public $aspect;

    /**
     * @var string
     */
    public $quality;

    /**
     * Video constructor.
     *
     * @param string $present Whether this programme has a picture. Legal values are `yes` or `no`.
     * @param string $colour Legal values are `yes` for colour and `no` for black-and-white.
     * @param string $aspect The horizontal:vertical aspect ratio, eg `4:3` or `16:9`.
     * @param string $quality Information on the quality, eg `HDTV`, `800x600`.
     */
    public function __construct(string $present = '', string $colour = '', string $aspect = '', string $quality = '')
    {
        $this->present = $present;
        $this->colour = $colour;
        $this->aspect = $aspect;
        $this->quality = $quality;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('video'))
            ->withOptionalChild(new XmlElement('present', $this->present))
            ->withOptionalChild(new XmlElement('colour', $this->colour))
            ->withOptionalChild(new XmlElement('aspect', $this->aspect))
            ->withOptionalChild(new XmlElement('quality', $this->quality));
    }
}
