# XMLTV

Test Change

[![Latest Stable Version](https://poser.pugx.org/jaylinski/xmltv/v/stable)](https://packagist.org/packages/jaylinski/xmltv)
[![Build](https://travis-ci.org/jaylinski/xmltv.svg?branch=master)](https://travis-ci.org/jaylinski/xmltv)
[![Code Coverage](https://codecov.io/gh/jaylinski/xmltv/branch/master/graph/badge.svg)](https://codecov.io/gh/jaylinski/xmltv)
[![Code Style](https://styleci.io/repos/101584271/shield)](https://styleci.io/repos/101584271)

A library for generating XMLTV files.

## Installation

Install the latest version with

`$ composer require jaylinski/xmltv`

## Usage

```php
<?php

use XmlTv\Tv;
use XmlTv\XmlTv;

require __DIR__.'/vendor/autoload.php';

$tv = new Tv();

$channel = new Tv\Channel('channel1');
$channel->addDisplayName(new Tv\Channel\DisplayName('Channel 1', 'en'));

$programme = new Tv\Programme('20170914190000 +0200', '20170914200000 +0200', 'channel1');
$programme->addTitle(new Tv\Programme\Title('CNN News', 'en'));
$programme->addDescription(new Tv\Programme\Desc('World news', 'en'));
$programme->addCategory(new Tv\Programme\Category('news', 'en'));

$tv->addChannel($channel);
$tv->addProgramme($programme);

$xml = XmlTv::generate($tv, $validate = true);
```

## Sources

You can write your own source by implementing the `XmlTv\Tv\Source` interface.

## Copyright and license

Copyright &copy; Jakob Linskeseder

XMLTV is licensed under the MIT License - see the `LICENSE` file for details.
