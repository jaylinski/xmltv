<?php

namespace spec\XmlTv;

use XmlTv\Tv;
use XmlTv\XmlElement;
use XmlTv\XmlTv;
use PhpSpec\ObjectBehavior;

class XmlTvSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(XmlTv::class);
    }

    function it_generates_an_xml_file_from_an_empty_tv_object()
    {
        $xml = file_get_contents(__DIR__.'/../epg-empty.xml');

        $this->generate(new Tv(), false)->shouldReturn($xml);
    }

    function it_generates_an_xml_file()
    {
        $xml = file_get_contents(__DIR__.'/../epg.xml');

        $tv = new Tv();

        $channel = new Tv\Channel('test');
        $channel->icon = new Tv\Channel\Icon('http://foo.bar/img.png', 200, 200);
        $channel->addDisplayName(new Tv\Channel\DisplayName('test', 'en'));
        $channel->addDisplayName(new Tv\Channel\DisplayName('test', 'de'));

        $programme = new Tv\Programme('1', '2', 'test');
        $programme->date = '1999';
        $programme->addTitle(new Tv\Programme\Title('title'));
        $programme->addSubTitle(new Tv\Programme\SubTitle('subtitle'));
        $programme->addDescription(new Tv\Programme\Desc('desc'));
        $programme->addCategory(new Tv\Programme\Category('category'));
        $programme->addKeyword(new Tv\Programme\Keyword('keyword'));

        $tv->addChannel($channel);
        $tv->addProgramme($programme);

        $this->generate($tv, false)->shouldReturn($xml);
    }

    function it_throws_if_the_generated_xml_does_not_validate()
    {
        $this->shouldThrow('XmlTv\Exceptions\ValidationException')->duringGenerate(new InvalidTv(), true);
    }
}

class InvalidTv extends Tv
{
    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('tv'))
            ->withAttribute('invalid', 'foo');
    }
}
