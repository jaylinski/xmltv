<?php

namespace XmlTv\Tv;

use XmlTv\Tv;

interface Source
{
    public function get(): Tv;
}
