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

class ActivitySpec extends ObjectBehavior
{
    function it_is_an_xapi_object()
    {
        $this->beConstructedWith('http://tincanapi.com/conformancetest/activityid');
        $this->shouldHaveType('Xabbuh\XApi\Model\Object');
    }
}
