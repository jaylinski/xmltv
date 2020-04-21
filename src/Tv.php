<?php

namespace XmlTv;

use XmlTv\Tv\Channel;
use XmlTv\Tv\Programme;

class Tv implements XmlSerializable
{
    protected const GENERATOR_INFO_NAME = 'jaylinski/xmltv';
    protected const GENERATOR_INFO_URL = 'https://github.com/jaylinski/xmltv';

    public const DATE_FORMAT = 'YmdHis O';

    /**
     * @var string
     */
    public $date;

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
     * @param string $date Should be the date when the listings were originally produced.
     * @param string $sourceInfoUrl
     * @param string $sourceInfoName
     * @param string $sourceDataUrl
     */
    public function __construct(string $date = '', string $sourceInfoUrl = '', string $sourceInfoName = '', string $sourceDataUrl = '')
    {
        $this->date = $date;
        $this->sourceInfoUrl = $sourceInfoUrl;
        $this->sourceInfoName = $sourceInfoName;
        $this->sourceDataUrl = $sourceDataUrl;
    }

    /**
     * @param Channel $channel
     */
    public function addChannel(Channel $channel): void
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
    public function addProgramme(Programme $programme): void
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

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('tv'))
            ->withAttribute('date', $this->date)
            ->withAttribute('source-info-name', $this->sourceInfoName)
            ->withAttribute('source-info-url', $this->sourceInfoUrl)
            ->withAttribute('source-data-url', $this->sourceDataUrl)
            ->withAttribute('generator-info-name', Tv::GENERATOR_INFO_NAME)
            ->withAttribute('generator-info-url', Tv::GENERATOR_INFO_URL)
            ->withChildren($this->getChannels())
            ->withChildren($this->getProgrammes());
    }
}
