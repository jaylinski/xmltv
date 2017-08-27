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
     * @var Channel[]
     */
    private $channels = [];

    /**
     * @var Programme[]
     */
    private $programmes = [];

    /**
     * Tv constructor.
     *
     * @param string $sourceInfoUrl
     * @param string $sourceInfoName
     */
    public function __construct(string $sourceInfoUrl, string $sourceInfoName)
    {
        $this->sourceInfoUrl = $sourceInfoUrl;
        $this->sourceInfoName = $sourceInfoName;
    }

    /**
     * @param Channel $channel
     */
    public function addChannel(Channel $channel)
    {
        array_push($this->channels, $channel);
    }

    /**
     * @return Channel[]
     */
    public function getChannels(): array
    {
        return $this->channels;
    }

    /**
     * @param Programme $programme
     */
    public function addProgramme(Programme $programme)
    {
        array_push($this->programmes, $programme);
    }

    /**
     * @return Programme[]
     */
    public function getProgrammes(): array
    {
        return $this->programmes;
    }
}
