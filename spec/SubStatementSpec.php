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
use Xabbuh\XApi\Model\Context;
use Xabbuh\XApi\Model\ContextActivities;
use Xabbuh\XApi\Model\Extensions;
use Xabbuh\XApi\Model\Group;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;
use Xabbuh\XApi\Model\StatementReference;
use Xabbuh\XApi\Model\SubStatement;
use Xabbuh\XApi\Model\Verb;

class SubStatementSpec extends ObjectBehavior
{
    function it_is_an_xapi_object()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', array('en-US' => 'test'));
        $object = new Activity('http://tincanapi.com/conformancetest/activityid');
        $this->beConstructedWith($actor, $verb, $object);

        $this->shouldHaveType('Xabbuh\XApi\Model\Object');
    }

    function it_is_different_from_another_sub_statement_if_contexts_differ()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', array('en-US' => 'test'));
        $object = new Activity('http://tincanapi.com/conformancetest/activityid');
        $this->beConstructedWith($actor, $verb, $object, null, new Context());

        $subStatement = new SubStatement($actor, $verb, $object);

        $this->equals($subStatement)->shouldReturn(false);

        $context = new Context();
        $context = $context->withRegistration('16fd2706-8baf-433b-82eb-8c7fada847da')
            ->withInstructor(new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com')))
            ->withTeam(new Group(InverseFunctionalIdentifier::withMbox('mailto:conformancetest-group@tincanapi.com')))
            ->withContextActivities(new ContextActivities(
                array(new Activity('http://tincanapi.com/conformancetest/activityid')),
                array(new Activity('http://tincanapi.com/conformancetest/activityid')),
                array(new Activity('http://tincanapi.com/conformancetest/activityid')),
                array(new Activity('http://tincanapi.com/conformancetest/activityid'))
            ))
            ->withRevision('test')
            ->withPlatform('test')
            ->withLanguage('en-US')
            ->withStatement(new StatementReference('16fd2706-8baf-433b-82eb-8c7fada847da'))
            ->withExtensions(new Extensions(array()))
        ;
        $subStatement = new SubStatement($actor, $verb, $object, null, $context);

        $this->equals($subStatement)->shouldReturn(false);
    }
}
