<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;

class ScoreSpec extends ObjectBehavior
{
    function its_properties_can_be_read()
    {
        $this->beConstructedWith(1, 100, 0, 100);

        $this->getScaled()->shouldReturn(1);
        $this->getRaw()->shouldReturn(100);
        $this->getMin()->shouldReturn(0);
        $this->getMax()->shouldReturn(100);
    }
}
