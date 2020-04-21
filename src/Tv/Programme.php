<?php

namespace XmlTv\Tv;

use XmlTv\Tv\Elements\Audio;
use XmlTv\Tv\Elements\Category;
use XmlTv\Tv\Elements\Country;
use XmlTv\Tv\Elements\Credits;
use XmlTv\Tv\Elements\Date;
use XmlTv\Tv\Elements\Desc;
use XmlTv\Tv\Elements\EpisodeNum;
use XmlTv\Tv\Elements\Icon;
use XmlTv\Tv\Elements\Keyword;
use XmlTv\Tv\Elements\Language;
use XmlTv\Tv\Elements\LastChance;
use XmlTv\Tv\Elements\Length;
use XmlTv\Tv\Elements\NewProgramme;
use XmlTv\Tv\Elements\OrigLanguage;
use XmlTv\Tv\Elements\Premiere;
use XmlTv\Tv\Elements\PreviouslyShown;
use XmlTv\Tv\Elements\Rating;
use XmlTv\Tv\Elements\Review;
use XmlTv\Tv\Elements\StarRating;
use XmlTv\Tv\Elements\SubTitle;
use XmlTv\Tv\Elements\Subtitles;
use XmlTv\Tv\Elements\Title;
use XmlTv\Tv\Elements\Url;
use XmlTv\Tv\Elements\Video;
use XmlTv\XmlElement;
use XmlTv\XmlSerializable;

class Programme implements XmlSerializable
{
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
    public $pdcStart;

    /**
     * @var string
     */
    public $vpsStart;

    /**
     * @var string
     */
    public $showview;

    /**
     * @var string
     */
    public $videoplus;

    /**
     * @var string
     */
    public $channel;

    /**
     * @var string Legal values are `0` or `1`.
     */
    public $clumpidx;

    /**
     * @var Title[]
     */
    private $title = [];

    /**
     * @var SubTitle[]
     */
    private $subTitle = [];

    /**
     * @var Desc[]
     */
    private $desc = [];

    /**
     * @var Credits[]
     */
    private $credits = [];

    /**
     * @var Date
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
     * @var Language
     */
    public $language;

    /**
     * @var OrigLanguage
     */
    public $origLanguage;

    /**
     * @var Length
     */
    public $length;

    /**
     * @var Icon[]
     */
    private $icon = [];

    /**
     * @var Url[]
     */
    private $url = [];

    /**
     * @var Country[]
     */
    private $country = [];

    /**
     * @var EpisodeNum[]
     */
    private $episodeNum = [];

    /**
     * @var Video
     */
    public $video;

    /**
     * @var Audio
     */
    public $audio;

    /**
     * @var PreviouslyShown
     */
    public $previouslyShown;

    /**
     * @var Premiere
     */
    public $premiere;

    /**
     * @var LastChance
     */
    public $lastChance;

    /**
     * @var NewProgramme
     */
    public $new;

    /**
     * @var Subtitles[]
     */
    private $subtitles = [];

    /**
     * @var Rating[]
     */
    private $rating = [];

    /**
     * @var StarRating[]
     */
    private $starRating = [];

    /**
     * @var Review[]
     */
    private $review = [];

    /**
     * Programme constructor.
     *
     * @param string $channel
     * @param string $start
     * @param string $stop
     * @param string $pdcStart
     * @param string $vpsStart
     * @param string $showview
     * @param string $videoplus
     * @param string $clumpidx
     */
    public function __construct(
        string $channel,
        string $start,
        string $stop = '',
        string $pdcStart = '',
        string $vpsStart = '',
        string $showview = '',
        string $videoplus = '',
        string $clumpidx = ''
    ) {
        $this->channel = $channel;
        $this->start = $start;
        $this->stop = $stop;
        $this->pdcStart = $pdcStart;
        $this->vpsStart = $vpsStart;
        $this->showview = $showview;
        $this->videoplus = $videoplus;
        $this->clumpidx = $clumpidx;
    }

    /**
     * Add a title.
     *
     * @param Title $title
     */
    public function addTitle(Title $title): void
    {
        array_push($this->title, $title);
    }

    /**
     * Get all titles.
     *
     * @return Title[]
     */
    public function getTitle(): array
    {
        return $this->title;
    }

    /**
     * Add a category.
     *
     * @param SubTitle $subTitle
     */
    public function addSubTitle(SubTitle $subTitle): void
    {
        array_push($this->subTitle, $subTitle);
    }

    /**
     * Get all sub-titles.
     *
     * @return SubTitle[]
     */
    public function getSubTitle(): array
    {
        return $this->subTitle;
    }

    /**
     * Add a description.
     *
     * @param Desc $desc
     */
    public function addDescription(Desc $desc): void
    {
        array_push($this->desc, $desc);
    }

    /**
     * Get all descriptions.
     *
     * @return Desc[]
     */
    public function getDescription(): array
    {
        return $this->desc;
    }

    /**
     * Add credits.
     *
     * @param Credits $credits
     */
    public function addCredits(Credits $credits): void
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
     * Add a category.
     *
     * @param Category $category
     */
    public function addCategory(Category $category): void
    {
        array_push($this->category, $category);
    }

    /**
     * Get all categories.
     *
     * @return Category[]
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * Add a keyword.
     *
     * @param Keyword $keyword
     */
    public function addKeyword(Keyword $keyword): void
    {
        array_push($this->keyword, $keyword);
    }

    /**
     * Get all keywords.
     *
     * @return Keyword[]
     */
    public function getKeyword(): array
    {
        return $this->keyword;
    }

    /**
     * Add an icon.
     *
     * @param Icon $icon
     */
    public function addIcon(Icon $icon): void
    {
        array_push($this->icon, $icon);
    }

    /**
     * Get all icons.
     *
     * @return Icon[]
     */
    public function getIcon(): array
    {
        return $this->icon;
    }

    /**
     * Add a url.
     *
     * @param Url $url
     */
    public function addUrl(Url $url): void
    {
        array_push($this->url, $url);
    }

    /**
     * Get all urls.
     *
     * @return Url[]
     */
    public function getUrl(): array
    {
        return $this->url;
    }

    /**
     * Add a country.
     *
     * @param Country $country
     */
    public function addCountry(Country $country): void
    {
        array_push($this->country, $country);
    }

    /**
     * Get all countries.
     *
     * @return Country[]
     */
    public function getCountry(): array
    {
        return $this->country;
    }

    /**
     * Add a episode-num.
     *
     * @param EpisodeNum $episodeNum
     */
    public function addEpisodeNum(EpisodeNum $episodeNum): void
    {
        array_push($this->episodeNum, $episodeNum);
    }

    /**
     * Get all episode-nums.
     *
     * @return EpisodeNum[]
     */
    public function getEpisodeNum(): array
    {
        return $this->episodeNum;
    }

    /**
     * Add subtitles.
     *
     * @param Subtitles $subtitles
     */
    public function addSubtitles(Subtitles $subtitles): void
    {
        array_push($this->subtitles, $subtitles);
    }

    /**
     * Get all subtitles.
     *
     * @return Subtitles[]
     */
    public function getSubtitles(): array
    {
        return $this->subtitles;
    }

    /**
     * Add a rating.
     *
     * @param Rating $rating
     */
    public function addRating(Rating $rating): void
    {
        array_push($this->rating, $rating);
    }

    /**
     * Get all ratings.
     *
     * @return Rating[]
     */
    public function getRating(): array
    {
        return $this->rating;
    }
    /**
     * Add a star-rating.
     *
     * @param StarRating $rating
     */
    public function addStarRating(StarRating $rating): void
    {
        array_push($this->starRating, $rating);
    }

    /**
     * Get all star-ratings.
     *
     * @return StarRating[]
     */
    public function getStarRating(): array
    {
        return $this->starRating;
    }

    /**
     * Add a review.
     *
     * @param Review $review
     */
    public function addReview(Review $review): void
    {
        array_push($this->review, $review);
    }

    /**
     * Get all reviews.
     *
     * @return Review[]
     */
    public function getReview(): array
    {
        return $this->review;
    }

    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('programme'))
            ->withAttribute('start', $this->start)
            ->withAttribute('stop', $this->stop)
            ->withAttribute('pdc-start', $this->pdcStart)
            ->withAttribute('vps-start', $this->vpsStart)
            ->withAttribute('showview', $this->showview)
            ->withAttribute('videoplus', $this->videoplus)
            ->withAttribute('channel', $this->channel)
            ->withAttribute('clumpidx', $this->clumpidx)
            ->withChildren($this->getTitle())
            ->withChildren($this->getSubTitle())
            ->withChildren($this->getDescription())
            ->withChildren($this->getCredits())
            ->withOptionalChild($this->date)
            ->withChildren($this->getCategory())
            ->withChildren($this->getKeyword())
            ->withOptionalChild($this->language)
            ->withOptionalChild($this->origLanguage)
            ->withOptionalChild($this->length)
            ->withChildren($this->getIcon())
            ->withChildren($this->getUrl())
            ->withChildren($this->getCountry())
            ->withChildren($this->getEpisodeNum())
            ->withOptionalChild($this->video)
            ->withOptionalChild($this->audio)
            ->withOptionalChild($this->previouslyShown)
            ->withOptionalChild($this->premiere)
            ->withOptionalChild($this->lastChance)
            ->withOptionalChild($this->new)
            ->withChildren($this->getSubtitles())
            ->withChildren($this->getRating())
            ->withChildren($this->getStarRating())
            ->withChildren($this->getReview());
    }
}
