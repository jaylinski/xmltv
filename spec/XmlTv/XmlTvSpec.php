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

    function it_generates_an_xml_file(Tv $tv)
    {
        $generatedFile = file_get_contents(__DIR__.'/../epg.xml');

        $tv->getChannels()->willReturn([new Tv\Channel('test')]);
        $tv->getProgrammes()->willReturn([new Tv\Programme('1', '2', 'test')]);
        $this->generate($tv)->shouldReturn($generatedFile);
    }
}
