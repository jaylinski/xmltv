<?php

namespace XmlTv;

use DOMDocument;
use XmlTv\Exceptions\ValidationException;
use XMLWriter;

class XmlTv
{
    const DTD = __DIR__.'/../spec/xmltv.dtd';

    /**
     * Generates an XMLTV file.
     *
     * @param Tv $tv
     * @param bool $validate
     * @return string
     * @throws ValidationException
     */
    public static function generate(Tv $tv, bool $validate = true)
    {
        $xmlWriter = new XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->setIndent(true);
        $xmlWriter->startDocument();

        if ($validate) {
            $xmlWriter->writeDTD('tv', null, null, file_get_contents(XmlTv::DTD));
        }

        $xmlWriter->startElement('tv');
        $xmlWriter->writeAttribute('source-info-name', $tv->sourceInfoName);
        $xmlWriter->writeAttribute('source-info-url', $tv->sourceInfoUrl);
        $xmlWriter->writeAttribute('source-data-url', $tv->sourceDataUrl);
        $xmlWriter->writeAttribute('generator-info-name', Tv::GENERATOR_INFO_NAME);
        $xmlWriter->writeAttribute('generator-info-url', Tv::GENERATOR_INFO_URL);

        foreach ($tv->getChannels() as $channel) {
            $xmlWriter->startElement('channel');
            $xmlWriter->writeAttribute('id', $channel->id);

            foreach ($channel->getDisplayNames() as $displayName) {
                $xmlWriter->startElement('display-name');
                $xmlWriter->writeAttribute('lang', $displayName->lang);
                $xmlWriter->text($displayName->value);
                $xmlWriter->endElement();
            }

            if (!is_null($channel->icon)) {
                $xmlWriter->startElement('icon');
                $xmlWriter->writeAttribute('src', $channel->icon->src);
                $xmlWriter->writeAttribute('width', $channel->icon->width);
                $xmlWriter->writeAttribute('height', $channel->icon->height);
                $xmlWriter->endElement();
            }

            $xmlWriter->endElement();
        }

        foreach ($tv->getProgrammes() as $programme) {
            $xmlWriter->startElement('programme');
            $xmlWriter->writeAttribute('start', $programme->start);
            $xmlWriter->writeAttribute('stop', $programme->stop);
            $xmlWriter->writeAttribute('channel', $programme->channel);

            foreach ($programme->getTitles() as $title) {
                $xmlWriter->startElement('title');
                $xmlWriter->writeAttribute('lang', $title->lang);
                $xmlWriter->text($title->value);
                $xmlWriter->endElement();
            }

            foreach ($programme->getSubTitles() as $subTitle) {
                $xmlWriter->startElement('sub-title');
                $xmlWriter->writeAttribute('lang', $subTitle->lang);
                $xmlWriter->text($subTitle->value);
                $xmlWriter->endElement();
            }

            foreach ($programme->getDescriptions() as $description) {
                $xmlWriter->startElement('desc');
                $xmlWriter->writeAttribute('lang', $description->lang);
                $xmlWriter->text($description->value);
                $xmlWriter->endElement();
            }

            if (!is_null($programme->date)) {
                $xmlWriter->writeElement('date', $programme->date);
            }

            foreach ($programme->getCategories() as $category) {
                $xmlWriter->startElement('category');
                $xmlWriter->writeAttribute('lang', $category->lang);
                $xmlWriter->text($category->value);
                $xmlWriter->endElement();
            }

            foreach ($programme->getKeywords() as $keyword) {
                $xmlWriter->startElement('keyword');
                $xmlWriter->writeAttribute('lang', $keyword->lang);
                $xmlWriter->text($keyword->value);
                $xmlWriter->endElement();
            }

            if (!is_null($programme->language)) {
                $xmlWriter->writeElement('language', $programme->language);
            }

            if (!is_null($programme->origLanguage)) {
                $xmlWriter->writeElement('orig-language', $programme->origLanguage);
            }

            $xmlWriter->endElement();
        }

        $xmlWriter->endElement();
        $xmlWriter->endDocument();

        $xml = $xmlWriter->outputMemory();

        if (XmlTV::isValid($xml) || !$validate) {
            return $xml;
        } else {
            throw new ValidationException('DTD validation failed: '.libxml_get_last_error()->message);
        }
    }

    /**
     * Validates an XMLTV string.
     *
     * @param string $xml
     * @return bool
     */
    public static function isValid(string $xml)
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadXML($xml);

        return $dom->validate();
    }
}
