<?php

namespace XmlTv\Tv\Elements;

use XmlTv\XmlElement;

class OrigLanguage extends Language
{
    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('orig-language', $this->value))
            ->withAttribute('lang', $this->lang);
    }
}
