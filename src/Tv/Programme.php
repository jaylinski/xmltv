<?php

namespace XmlTv\Tv;

class Programme
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
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $subTitle;

    /**
     * @var string
     */
    public $desc;

    /**
     * @var Category[]
     */
    private $categories = [];

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
     * Add a category.
     *
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        array_push($this->categories, $category);
    }

    /**
     * Get all categories.
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
