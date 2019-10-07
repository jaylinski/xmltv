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
    public $director = [];

    /**
     * @var Actor[]
     */
    public $actor = [];

    /**
     * @var Writer[]
     */
    public $writer = [];

    /**
     * @var Adapter[]
     */
    public $adapter = [];

    /**
     * @var Producer[]
     */
    public $producer = [];

    /**
     * @var Composer[]
     */
    public $composer = [];

    /**
     * @var Editor[]
     */
    public $editor = [];

    /**
     * @var Presenter[]
     */
    public $presenter = [];

    /**
     * @var Commentator[]
     */
    public $commentator = [];

    /**
     * @var Guest[]
     */
    public $guest = [];

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
