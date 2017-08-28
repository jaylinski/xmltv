<?php

namespace spec\XmlTv;

use XmlTv\Tv;
use PhpSpec\ObjectBehavior;

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
