<?php

namespace spec\XmlTv;

use XmlTv\Tv;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TvSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('', '');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Tv::class);
    }
}
