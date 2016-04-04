<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;

class ActivitySpec extends ObjectBehavior
{
    function it_is_an_xapi_object()
    {
        $this->beConstructedWith('http://tincanapi.com/conformancetest/activityid');
        $this->shouldHaveType('Xabbuh\XApi\Model\Object');
    }
}
