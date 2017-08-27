<?php

namespace XmlTv\Sources;

use Psr\SimpleCache\CacheInterface;
use XmlTv\Tv;
use XmlTv\Tv\Category;
use XmlTv\Tv\Channel;
use XmlTv\Tv\DisplayName;
use XmlTv\Tv\Programme;

class A1 implements Source
{
    const SOURCE_INFO_URL = '';
    const SOURCE_INFO_NAME = 'A1';

    const SOURCE_CHANNELS = 'https://epggw.a1.net/a/api.mobile.start?type=JSON.3';
    const SOURCE_CHANNEL_INFO = 'https://epggw.a1.net/a/api.mobile.event.hour';
    const SOURCE_CHANNEL_LOGO = 'http://epggw.a1.net/img/station/darkbg/200x200/';

    /**
     * @var Tv
     */
    private $tv;

    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->tv = new Tv(self::SOURCE_INFO_URL, self::SOURCE_INFO_NAME);
        $this->cache = $cache;
    }

    public function get(): Tv
    {
        $this->load();

        return $this->tv;
    }

    private function load()
    {
        echo 'Loading channels ...'.PHP_EOL;
        $this->loadChannels();

        echo 'Loading programmes ...'.PHP_EOL;
        foreach ($this->tv->getChannels() as $channel) {
            echo 'Loading programme info for "'.$channel->getDisplayNames()[0]->name.'"'.PHP_EOL;
            $this->loadProgramme($channel->id);
        }
    }

    private function loadChannels()
    {
        $cacheKey = 'channels';

        if ($this->cache->has($cacheKey)) {
            echo 'Loading infos from cache "'.$cacheKey.'"'.PHP_EOL;
            $rawJson = $this->cache->get($cacheKey);
        } else {
            echo 'Loading infos from URL '.self::SOURCE_CHANNELS.PHP_EOL;
            $rawJson = $this->loadUrl(self::SOURCE_CHANNELS);
        }

        $channels = json_decode($rawJson, true);
        if (is_array($channels) && isset($channels[3])) {
            $this->cache->set($cacheKey, $rawJson);
            $this->addChannels($channels[3]);
        } else {
            throw new \RuntimeException('Could not decode JSON.');
        }
    }

    private function loadProgramme($channelId)
    {
        $date = date('Ymd\T0000/48\H', time());
        $cacheKey = sprintf('date.%s.%s', preg_replace('/[^0-9]/', '', $date), $channelId);

        if ($this->cache->has($cacheKey)) {
            echo 'Loading infos from cache "'.$cacheKey.'"'.PHP_EOL;
            $rawJson = $this->cache->get($cacheKey);
        } else {
            $channelInfoUrl = $this->getChannelInfoUrl($channelId, $date);
            echo 'Loading infos from URL '.$channelInfoUrl.PHP_EOL;
            $rawJson = $this->loadUrl($channelInfoUrl);
        }

        $programmes = json_decode($rawJson, true);
        if (is_array($programmes) && isset($programmes[1][0][2])) {
            $this->cache->set($cacheKey, $rawJson);
            $this->addProgrammes($programmes[1][0][2], $channelId);
        } else {
            throw new \RuntimeException('Could not decode JSON.');
        }
    }

    private function loadUrl(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'XMLTV Generator');
        $result = curl_exec($ch);

        if(!curl_errno($ch) && $result) {
            return $result;
        } else {
            throw new \RuntimeException('cURL request failed.');
        }
    }

    private function addChannels($data)
    {
        foreach ($data as $channelInfo)
        {
            $channel = new Channel($channelInfo[0]);
            $channel->icon = self::SOURCE_CHANNEL_LOGO.$channelInfo[0].'.png';
            $channel->addDisplayName(new DisplayName($channelInfo[2]));
            if (isset($channelInfo[3][0])) {
                $channel->addDisplayName(new DisplayName($channelInfo[3][0]));
            }
            $this->tv->addChannel($channel);
        }
    }

    private function addProgrammes($data, $channelId)
    {
        foreach ($data as $programmeInfo) {
            $programme = new Programme(
                date(Programme::DATE_FORMAT, $programmeInfo[1]),
                date(Programme::DATE_FORMAT, $programmeInfo[2]),
                $channelId
            );
            $programme->title = $programmeInfo[3];
            $programme->subTitle = $programmeInfo[4];
            $programme->addCategory(new Category($programmeInfo[5][0]));
            $this->tv->addProgramme($programme);
        }
    }

    private function getChannelInfoUrl(string $id, string $period)
    {
        return self::SOURCE_CHANNEL_INFO.'?'.http_build_query([
            'period' => $period,
            'stationId' => $id,
            'type' => 'JSON.6',
        ]);
    }
}