# XMLTV

[![Latest Stable Version](https://poser.pugx.org/jaylinski/xmltv/v/stable)](https://packagist.org/packages/jaylinski/xmltv)
[![Build](https://travis-ci.org/jaylinski/xmltv.svg?branch=master)](https://travis-ci.org/jaylinski/xmltv)
[![Code Style](https://styleci.io/repos/101584271/shield)](https://styleci.io/repos/101584271)

A library for generating XMLTV files.

## Installation

Install the latest version with

`$ composer require jaylinski/xmltv`

## Usage

```php
<?php

use XmlTv\Sources\Foo;
use XmlTv\XmlTv;

require __DIR__.'/vendor/autoload.php';

$xml = XmlTv::generate(new Tv(), $validate = true);
```

## Sources

You can write your own source by implementing the `XmlTv\Tv\Source` interface.

## Copyright and license

Copyright &copy; Jakob Linskeseder

XMLTV is licensed under the MIT License - see the `LICENSE` file for details.
