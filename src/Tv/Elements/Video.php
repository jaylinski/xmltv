<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Video implements XmlSerializable
{
    /**
     * Video constructor.
     *
     * @param string $present Whether this programme has a picture. Legal values are `yes` or `no`.
     * @param string $colour Legal values are `yes` for colour and `no` for black-and-white.
     * @param string $aspect The horizontal:vertical aspect ratio, eg `4:3` or `16:9`.
     * @param string $quality Information on the quality, eg `HDTV`, `800x600`.
     */
    public function __construct(
        public string $present = '',
        public string $colour = '',
        public string $aspect = '',
        public string $quality = ''
    ) {
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('video'))
            ->withChild(new XmlElement('present', $this->present))
            ->withChild(new XmlElement('colour', $this->colour))
            ->withChild(new XmlElement('aspect', $this->aspect))
            ->withChild(new XmlElement('quality', $this->quality));
    }
}
