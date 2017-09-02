<?php

namespace XmlTv;

use XmlTv\Tv\Channel;
use XmlTv\Tv\Programme;

class Tv
{
    const GENERATOR_INFO_NAME = 'jaylinski/xmltv';
    const GENERATOR_INFO_URL = 'https://github.com/jaylinski/xmltv';

    /**
     * @var string
     */
    public $sourceInfoUrl;

    /**
     * @var string
     */
    public $sourceInfoName;

    /**
     * @var string
     */
    public $sourceDataUrl;

    /**
     * @var Channel[]
     */
    private $channel = [];

    /**
     * @var Programme[]
     */
    private $programme = [];

    /**
     * Tv constructor.
     *
     * @param string $sourceInfoUrl
     * @param string $sourceInfoName
     * @param string $sourceDataUrl
     */
    public function __construct(string $sourceInfoUrl = '', string $sourceInfoName = '', string $sourceDataUrl = '')
    {
        $this->sourceInfoUrl = $sourceInfoUrl;
        $this->sourceInfoName = $sourceInfoName;
        $this->sourceDataUrl = $sourceDataUrl;
    }

    /**
     * @param Channel $channel
     */
    public function addChannel(Channel $channel)
    {
        array_push($this->channel, $channel);
    }

    /**
     * @return Channel[]
     */
    public function getChannels(): array
    {
        return $this->channel;
    }

    /**
     * @param Programme $programme
     */
    public function addProgramme(Programme $programme)
    {
        array_push($this->programme, $programme);
    }

    /**
     * @return Programme[]
     */
    public function getProgrammes(): array
    {
        return $this->programme;
    }
}
