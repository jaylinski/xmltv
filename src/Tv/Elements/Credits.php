<?php

namespace XmlTv\Tv\Elements;

use XmlTv\Tv\Elements\Credits\Actor;
use XmlTv\Tv\Elements\Credits\Adapter;
use XmlTv\Tv\Elements\Credits\Commentator;
use XmlTv\Tv\Elements\Credits\Composer;
use XmlTv\Tv\Elements\Credits\Director;
use XmlTv\Tv\Elements\Credits\Editor;
use XmlTv\Tv\Elements\Credits\Guest;
use XmlTv\Tv\Elements\Credits\Presenter;
use XmlTv\Tv\Elements\Credits\Producer;
use XmlTv\Tv\Elements\Credits\Writer;
use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Credits implements XmlSerializable
{
    /**
     * @var Director[]
     */
    public array $director = [];

    /**
     * @var Actor[]
     */
    public array $actor = [];

    /**
     * @var Writer[]
     */
    public array $writer = [];

    /**
     * @var Adapter[]
     */
    public array $adapter = [];

    /**
     * @var Producer[]
     */
    public array $producer = [];

    /**
     * @var Composer[]
     */
    public array $composer = [];

    /**
     * @var Editor[]
     */
    public array $editor = [];

    /**
     * @var Presenter[]
     */
    public array $presenter = [];

    /**
     * @var Commentator[]
     */
    public array $commentator = [];

    /**
     * @var Guest[]
     */
    public array $guest = [];

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('credits'))
            ->withChildren($this->director)
            ->withChildren($this->actor)
            ->withChildren($this->writer)
            ->withChildren($this->adapter)
            ->withChildren($this->producer)
            ->withChildren($this->composer)
            ->withChildren($this->editor)
            ->withChildren($this->presenter)
            ->withChildren($this->commentator)
            ->withChildren($this->guest);
    }
}
