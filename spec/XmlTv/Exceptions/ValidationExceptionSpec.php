<?php

namespace spec\XmlTv\Exceptions;

use XmlTv\Exceptions\ValidationException;
use PhpSpec\ObjectBehavior;

class ValidationExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ValidationException::class);
        $this->shouldImplement(\Exception::class);
    }
}
