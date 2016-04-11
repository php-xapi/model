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

class AccountSpec extends ObjectBehavior
{
    function its_properties_can_be_read()
    {
        $this->beConstructedWith('test', 'https://tincanapi.com');

        $this->getName()->shouldReturn('test');
        $this->getHomePage()->shouldReturn('https://tincanapi.com');
    }
}
