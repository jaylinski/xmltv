<?php

namespace XmlTv;

use XMLWriter;

class XmlTv
{
    /**
     * Generates an XMLTV file.
     *
     * @param Tv $tv
     * @return string
     */
    public static function generate(Tv $tv)
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument();

        $xml->startElement('tv');
        $xml->writeAttribute('source-info-name', $tv->sourceInfoName);
        $xml->writeAttribute('source-info-url', $tv->sourceInfoUrl);
        $xml->writeAttribute('generator-info-name', Tv::GENERATOR_INFO_NAME);
        $xml->writeAttribute('generator-info-url', Tv::GENERATOR_INFO_URL);

        foreach ($tv->getChannels() as $channel) {
            $xml->startElement('channel');
            $xml->writeAttribute('id', $channel->id);
            foreach ($channel->getDisplayNames() as $displayName) {
                $xml->writeElement('display-name', $displayName->name);
            }
            $xml->writeElement('icon', $channel->icon);
            $xml->endElement();
        }

        foreach ($tv->getProgrammes() as $programme) {
            $xml->startElement('programme');
            $xml->writeAttribute('start', $programme->start);
            $xml->writeAttribute('stop', $programme->stop);
            $xml->writeAttribute('channel', $programme->channel);
            $xml->writeElement('title', $programme->title);
            $xml->writeElement('subTitle', $programme->subTitle);
            $xml->writeElement('desc', $programme->desc);
            foreach ($programme->getCategories() as $category) {
                $xml->writeElement('category', $category->name);
            }
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();

        return $xml->outputMemory();
    }
}
