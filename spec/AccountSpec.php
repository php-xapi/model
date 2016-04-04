<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;

class AccountSpec extends ObjectBehavior
{
    function its_properties_can_be_read()
    {
        $this->beConstructedWith('test', 'https://tincanapi.com');

        $this->getName()->shouldReturn('test');
        $this->getHomePage()->shouldReturn('https://tincanapi.com');
    }
}
