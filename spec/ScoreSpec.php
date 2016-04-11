<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    function it_can_be_constructed_with_a_scaled_value_only()
    {
        $this->beConstructedWith(1);

        $this->getScaled()->shouldReturn(1);
        $this->getRaw()->shouldReturn(null);
        $this->getMin()->shouldReturn(null);
        $this->getMax()->shouldReturn(null);
    }

    function it_can_be_constructed_with_a_raw_value_only()
    {
        $this->beConstructedWith(null, 100);

        $this->getScaled()->shouldReturn(null);
        $this->getRaw()->shouldReturn(100);
        $this->getMin()->shouldReturn(null);
        $this->getMax()->shouldReturn(null);
    }

    function it_can_be_constructed_with_a_min_value_only()
    {
        $this->beConstructedWith(null, null, 0);

        $this->getScaled()->shouldReturn(null);
        $this->getRaw()->shouldReturn(null);
        $this->getMin()->shouldReturn(0);
        $this->getMax()->shouldReturn(null);
    }

    function it_can_be_constructed_with_a_max_value_only()
    {
        $this->beConstructedWith(null, null, null, 100);

        $this->getScaled()->shouldReturn(null);
        $this->getRaw()->shouldReturn(null);
        $this->getMin()->shouldReturn(null);
        $this->getMax()->shouldReturn(100);
    }
}
