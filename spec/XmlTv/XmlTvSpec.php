<?php

namespace spec\XmlTv;

use XmlTv\Tv;
use XmlTv\XmlTv;
use PhpSpec\ObjectBehavior;

class XmlTvSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(XmlTv::class);
    }

    function it_generates_an_xml_file_from_an_empty_tv_object(Tv $tv)
    {
        $xml = file_get_contents(__DIR__.'/../epg-empty.xml');

        $tv->getChannels()->shouldBeCalled()->willReturn([]);
        $tv->getProgrammes()->shouldBeCalled()->willReturn([]);

        $this->generate($tv, false)->shouldReturn($xml);
    }

    function it_generates_an_xml_file(Tv $tv)
    {
        $xml = file_get_contents(__DIR__.'/../epg.xml');

        $channel = new Tv\Channel('test');
        $channel->icon = new Tv\Channel\Icon('http://foo.bar/img.png', 200, 200);
        $channel->addDisplayName(new Tv\Channel\DisplayName('test', 'en'));
        $channel->addDisplayName(new Tv\Channel\DisplayName('test', 'de'));

        $programme = new Tv\Programme('1', '2', 'test');
        $programme->date = '1999';
        $programme->addTitle(new Tv\Programme\Title('foo'));
        $programme->addSubTitle(new Tv\Programme\SubTitle('bar'));

        $tv->getChannels()->shouldBeCalled()->willReturn([$channel]);
        $tv->getProgrammes()->shouldBeCalled()->willReturn([$programme]);

        $tmp = $this->generate($tv, false);
        $this->generate($tv, false)->shouldReturn($xml);
    }
}
