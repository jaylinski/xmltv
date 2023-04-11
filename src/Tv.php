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
     * @var Channel[]
     */
    private array $channel = [];

    /**
     * @var Programme[]
     */
    private array $programme = [];

    /**
     * Tv constructor.
     *
     * @param string $date Should be the date when the listings were originally produced.
     */
    public function __construct(
        public string $date = '',
        public string $sourceInfoUrl = '',
        public string $sourceInfoName = '',
        public string $sourceDataUrl = ''
    ) {
    }

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
