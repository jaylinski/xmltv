<?php

namespace XmlTv\Sources;

use XmlTv\Tv;

interface Source
{
    public function get(): Tv;
}
