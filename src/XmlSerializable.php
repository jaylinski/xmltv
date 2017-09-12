<?php

namespace XmlTv;

interface XmlSerializable
{
    public function xmlSerialize(): XmlElement;
}
