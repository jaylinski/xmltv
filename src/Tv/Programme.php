<?php

namespace XmlTv\Tv;

use XmlTv\Tv\Programme\Category;
use XmlTv\Tv\Programme\Credits;
use XmlTv\Tv\Programme\Desc;
use XmlTv\Tv\Programme\EpisodeNum;
use XmlTv\Tv\Programme\Icon;
use XmlTv\Tv\Programme\Keyword;
use XmlTv\Tv\Programme\PreviouslyShown;
use XmlTv\Tv\Programme\SubTitle;
use XmlTv\Tv\Programme\Title;
use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

/*
 * Todo: url*, country*, episode-num*, video?, audio?, previously-shown?, premiere?, last-chance?, new?,
 *       subtitles*, rating*, star-rating*, review*
 */

class Programme implements XmlSerializable
{
    const DATE_FORMAT = 'YmdHis O';

    /**
     * @var string
     */
    public $start;

    /**
     * @var string
     */
    public $stop;

    /**
     * @var string
     */
    public $channel;

    /**
     * @var Title[]
     */
    private $title = [];

    /**
     * @var SubTitle[]
     */
    private $subTitle = [];

    /**
     * @var ?PreviouslyShown
     */
    private $previouslyShown;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var Desc[]
     */
    private $desc = [];

    /**
     * @var Credits[]
     */
    private $credits;

    /**
     * @var string
     */
    public $date;

    /**
     * @var Category[]
     */
    private $category = [];

    /**
     * @var Keyword[]
     */
    private $keyword = [];

    /**
     * @var string
     */
    public $language;

    /**
     * @var string
     */
    public $origLanguage;

    /**
     * @var string
     */
    public $length;

    /**
     * @var bool
     */
    public $premiere = false;

    /**
     * @var bool
     */
    public $new = false;

    /**
     * @var EpisodeNum[]
     */
    public $episodeNums = [];

    /**
     * Programme constructor.
     *
     * @param string $start
     * @param string $stop
     * @param string $channel
     */
    public function __construct(string $start, string $stop, string $channel)
    {
        $this->start = $start;
        $this->stop = $stop;
        $this->channel = $channel;
    }

    /**
     * Add a title.
     *
     * @param Title $title
     */
    public function addTitle(Title $title)
    {
        array_push($this->title, $title);
    }

    /**
     * Get all titles.
     *
     * @return Title[]
     */
    public function getTitles(): array
    {
        return $this->title;
    }

    /**
     * Add a category.
     *
     * @param SubTitle $subTitle
     */
    public function addSubTitle(SubTitle $subTitle)
    {
        array_push($this->subTitle, $subTitle);
    }

    /**
     * Get all sub-titles.
     *
     * @return SubTitle[]
     */
    public function getSubTitles(): array
    {
        return $this->subTitle;
    }

    /**
     * Add a previous showing.
     *
     * @param PreviouslyShown $previouslyShown
     */
    public function setPreviouslyShown(PreviouslyShown $previouslyShown)
    {
        $this->previouslyShown = $previouslyShown;
    }

    /**
     * Get all showings.
     *
     * @return PreviouslyShown[]
     */
    public function getPreviouslyShown(): ?PreviouslyShown
    {
        return $this->previouslyShown;
    }

    /**
     * Add a description.
     *
     * @param Desc $desc
     */
    public function addDescription(Desc $desc)
    {
        array_push($this->desc, $desc);
    }

    /**
     * Get all descriptions.
     *
     * @return Desc[]
     */
    public function getDescriptions(): array
    {
        return $this->desc;
    }

    /**
     * Add credits.
     *
     * @param Credits $credits
     */
    public function addCredits(Credits $credits)
    {
        array_push($this->credits, $credits);
    }

    /**
     * Get all credits.
     *
     * @return Credits[]
     */
    public function getCredits(): array
    {
        return $this->credits;
    }

    /**
     * Add episodeNums.
     *
     * @param EpisodeNum $episodeNum
     */
    public function addEpisodeNum(EpisodeNum $episodeNums)
    {
        array_push($this->episodeNums, $episodeNums);
    }

    /**
     * Get all episodeNums.
     *
     * @return EpisodeNums[]
     */
    public function getEpisodeNums(): array
    {
        return $this->episodeNums;
    }

    /**
     * Add a category.
     *
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        array_push($this->category, $category);
    }

    /**
     * Get all categories.
     *
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->category;
    }

    /**
     * Add a icon.
     *
     * @param string $icon
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
    }

    /**
     * Get all categories.
     *
     * @return string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * Add a keyword.
     *
     * @param Keyword $keyword
     */
    public function addKeyword(Keyword $keyword)
    {
        array_push($this->keyword, $keyword);
    }

    /**
     * Get all keywords.
     *
     * @return Keyword[]
     */
    public function getKeywords(): array
    {
        return $this->keyword;
    }

    public function xmlSerialize(): XmlElement
    {
        $xml = (new XmlElement('programme'))
            ->withAttribute('start', $this->start)
            ->withAttribute('stop', $this->stop)
            ->withAttribute('channel', $this->channel)
            ->withChildren($this->getTitles())
            ->withChildren($this->getSubTitles())
            ->withChildren($this->getDescriptions())
            ->withChild(new XmlElement('date', $this->date))
            ->withChildren($this->getCategories())
            ->withChildren($this->getKeywords())
            ->withChild(new XmlElement('language', $this->language))
            ->withChild(new XmlElement('orig-language', $this->origLanguage))
            ->withChildren($this->getEpisodeNums());

        //$xml->withChild((new XmlElement('episode-num'))->withAttribute('system', 'onscreen'));

        if ($this->icon) {
            $xml->withChild((new XmlElement('icon'))->withAttribute('src', $this->getIcon()));
        }

        if ($this->premiere) {
            $xml->withChild(new XmlElement('premiere'));
        }

        if ($this->new) {
            $xml->withChild(new XmlElement('new', null));
        }

        if ($this->getPreviouslyShown()) {
            $xml->withChild($this->getPreviouslyShown());
        }

        return $xml;
    }
}
