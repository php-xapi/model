<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Activity;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\Group;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;
use Xabbuh\XApi\Model\Verb;

class StatementSpec extends ObjectBehavior
{
    function let()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', array('en-US' => 'test'));
        $object = new Activity('http://tincanapi.com/conformancetest/activityid');
        $this->beConstructedWith('39e24cc4-69af-4b01-a824-1fdc6ea8a3af', $actor, $verb, $object);
    }

    function it_creates_reference_to_itself()
    {
        $reference = $this->getStatementReference();
        $reference->shouldBeAnInstanceOf('Xabbuh\XApi\Model\StatementReference');
        $reference->getStatementId()->shouldReturn('39e24cc4-69af-4b01-a824-1fdc6ea8a3af');
    }

    function it_creates_statement_voiding_itself()
    {
        $voidingActor = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $voidingStatement = $this->getVoidStatement($voidingActor);
        $voidingStatement->getActor()->shouldBe($voidingActor);
        $voidingStatement->getVerb()->getId()->shouldReturn('http://adlnet.gov/expapi/verbs/voided');

        $voidedStatement = $voidingStatement->getObject();
        $voidedStatement->shouldBeAnInstanceOf('Xabbuh\XApi\Model\StatementReference');
        $voidedStatement->getStatementId()->shouldReturn('39e24cc4-69af-4b01-a824-1fdc6ea8a3af');
    }

    function it_can_be_authorized()
    {
        $authority = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $authorizedStatement = $this->withAuthority($authority);
        $authorizedStatement->getAuthority()->shouldReturn($authority);

        $authorizedStatement->shouldBeAnInstanceOf('Xabbuh\XApi\Model\Statement');
        $authorizedStatement->getActor()->equals($this->getActor())->shouldBe(true);
        $authorizedStatement->getVerb()->equals($this->getVerb())->shouldBe(true);
        $authorizedStatement->getObject()->equals($this->getObject())->shouldBe(true);
    }

    function it_overrides_existing_authority_when_it_is_authorized()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', array('en-US' => 'test'));
        $object = new Activity('http://tincanapi.com/conformancetest/activityid');
        $authority = new Group(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $this->beConstructedWith('39e24cc4-69af-4b01-a824-1fdc6ea8a3af', $actor, $verb, $object, null, $authority);

        $authority = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $authorizedStatement = $this->withAuthority($authority);
        $authorizedStatement->getAuthority()->shouldReturn($authority);

        $authorizedStatement->shouldBeAnInstanceOf('Xabbuh\XApi\Model\Statement');
        $authorizedStatement->getActor()->equals($this->getActor())->shouldBe(true);
        $authorizedStatement->getVerb()->equals($this->getVerb())->shouldBe(true);
        $authorizedStatement->getObject()->equals($this->getObject())->shouldBe(true);
        $authorizedStatement->getAuthority()->equals($this->getAuthority())->shouldBe(false);
    }
}
