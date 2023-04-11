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
     * @var string A programme specific identifier for catchup URLs. Not part of the XMLTV specification.
     * @see https://github.com/kodi-pvr/pvr.iptvsimple/tree/7.0.0-Matrix#supported-m3u-and-xmltv-elements
     */
    public string $catchupId = '';

    /**
     * @var Title[]
     */
    private array $title = [];

    /**
     * @var SubTitle[]
     */
    private array $subTitle = [];

    /**
     * @var Desc[]
     */
    private array $desc = [];

    /**
     * @var Credits[]
     */
    private array $credits = [];

    public ?Date $date = null;

    /**
     * @var Category[]
     */
    private array $category = [];

    /**
     * @var Keyword[]
     */
    private array $keyword = [];

    public ?Language $language = null;
    public ?OrigLanguage $origLanguage = null;
    public ?Length $length = null;

    /**
     * @var Icon[]
     */
    private array $icon = [];

    /**
     * @var Url[]
     */
    private array $url = [];

    /**
     * @var Country[]
     */
    private array $country = [];

    /**
     * @var EpisodeNum[]
     */
    private array $episodeNum = [];

    public ?Video $video = null;
    public ?Audio $audio = null;
    public ?PreviouslyShown $previouslyShown = null;
    public ?Premiere $premiere = null;
    public ?LastChance $lastChance = null;
    public ?NewProgramme $new = null;

    /**
     * @var Subtitles[]
     */
    private array $subtitles = [];

    /**
     * @var Rating[]
     */
    private array $rating = [];

    /**
     * @var StarRating[]
     */
    private array $starRating = [];

    /**
     * @var Review[]
     */
    private array $review = [];

    public function __construct(
        public string $channel,
        public string $start,
        public string $stop = '',
        public string $pdcStart = '',
        public string $vpsStart = '',
        public string $showview = '',
        public string $videoplus = '',
        /** @var string Legal values are `0` or `1`. */
        public string $clumpidx = ''
    ) {
    }

    /**
     * Add a title.
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
            ->withAttribute('channel', $this->channel)
            ->withAttribute('start', $this->start)
            ->withAttribute('stop', $this->stop)
            ->withAttribute('pdc-start', $this->pdcStart)
            ->withAttribute('vps-start', $this->vpsStart)
            ->withAttribute('showview', $this->showview)
            ->withAttribute('videoplus', $this->videoplus)
            ->withAttribute('clumpidx', $this->clumpidx)
            ->withAttribute('catchup-id', $this->catchupId)
            ->withChildren($this->getTitle())
            ->withChildren($this->getSubTitle())
            ->withChildren($this->getDescription())
            ->withChildren($this->getCredits())
            ->withChild($this->date)
            ->withChildren($this->getCategory())
            ->withChildren($this->getKeyword())
            ->withChild($this->language)
            ->withChild($this->origLanguage)
            ->withChild($this->length)
            ->withChildren($this->getIcon())
            ->withChildren($this->getUrl())
            ->withChildren($this->getCountry())
            ->withChildren($this->getEpisodeNum())
            ->withChild($this->video)
            ->withChild($this->audio)
            ->withChild($this->previouslyShown)
            ->withChild($this->premiere)
            ->withChild($this->lastChance)
            ->withChild($this->new)
            ->withChildren($this->getSubtitles())
            ->withChildren($this->getRating())
            ->withChildren($this->getStarRating())
            ->withChildren($this->getReview());
    }
}
