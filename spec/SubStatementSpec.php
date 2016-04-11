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
use Xabbuh\XApi\Model\Activity;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;
use Xabbuh\XApi\Model\Verb;

class SubStatementSpec extends ObjectBehavior
{
    function it_is_an_xapi_object()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', array('en-US' => 'test'));
        $object = new Activity('http://tincanapi.com/conformancetest/activityid');
        $this->beConstructedWith('16fd2706-8baf-433b-82eb-8c7fada847da', $actor, $verb, $object);

        $this->shouldHaveType('Xabbuh\XApi\Model\Object');
    }
}
