<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Audio implements XmlSerializable
{
    /**
     * @var string
     */
    public $present;

    /**
     * @var string
     */
    public $stereo;

    /**
     * Audio constructor.
     *
     * @param string $present Whether this programme has a sound. Legal values are `yes` or `no`.
     * @param string $stereo Description of the stereo-ness of the sound.
     *                       Legal values are `mono`, `stereo`, `dolby`, `dolby digital`, `bilingual` and `surround`.
     */
    public function __construct(string $present = '', string $stereo = '')
    {
        $this->present = $present;
        $this->stereo = $stereo;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('audio'))
            ->withChild(new XmlElement('present', $this->present))
            ->withChild(new XmlElement('stereo', $this->stereo));
    }
}
