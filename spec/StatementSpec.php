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
use Xabbuh\XApi\Model\Group;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;
use Xabbuh\XApi\Model\LanguageMap;
use Xabbuh\XApi\Model\Result;
use Xabbuh\XApi\Model\Statement;
use Xabbuh\XApi\Model\StatementId;
use Xabbuh\XApi\Model\StatementReference;
use Xabbuh\XApi\Model\Verb;

class StatementSpec extends ObjectBehavior
{
    function let()
    {
        $id = StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af');
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', LanguageMap::create(array('en-US' => 'test')));
        $object = new Activity('http://tincanapi.com/conformancetest/activityid');
        $this->beConstructedWith($id, $actor, $verb, $object);
    }

    function it_creates_reference_to_itself()
    {
        $reference = $this->getStatementReference();
        $reference->shouldBeAnInstanceOf('Xabbuh\XApi\Model\StatementReference');
        $reference->getStatementId()->equals(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'))->shouldReturn(true);
    }

    function it_creates_statement_voiding_itself()
    {
        $voidingActor = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $voidingStatement = $this->getVoidStatement($voidingActor);
        $voidingStatement->getActor()->shouldBe($voidingActor);
        $voidingStatement->getVerb()->getId()->shouldReturn('http://adlnet.gov/expapi/verbs/voided');

        $voidedStatement = $voidingStatement->getObject();
        $voidedStatement->shouldBeAnInstanceOf('Xabbuh\XApi\Model\StatementReference');
        $voidedStatement->getStatementId()->equals(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'))->shouldReturn(true);
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
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', LanguageMap::create(array('en-US' => 'test')));
        $object = new Activity('http://tincanapi.com/conformancetest/activityid');
        $authority = new Group(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $this->beConstructedWith(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'), $actor, $verb, $object, null, $authority);

        $authority = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $authorizedStatement = $this->withAuthority($authority);
        $authorizedStatement->getAuthority()->shouldReturn($authority);

        $authorizedStatement->shouldBeAnInstanceOf('Xabbuh\XApi\Model\Statement');
        $authorizedStatement->getActor()->equals($this->getActor())->shouldBe(true);
        $authorizedStatement->getVerb()->equals($this->getVerb())->shouldBe(true);
        $authorizedStatement->getObject()->equals($this->getObject())->shouldBe(true);
        $authorizedStatement->getAuthority()->equals($this->getAuthority())->shouldBe(false);
    }

    function its_object_can_be_an_agent()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', LanguageMap::create(array('en-US' => 'test')));
        $object = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $this->beConstructedWith(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'), $actor, $verb, $object);

        $this->getObject()->shouldBeAnInstanceOf('Xabbuh\XApi\Model\Object');
        $this->getObject()->shouldBe($object);
    }

    function it_does_not_equal_another_statement_with_different_timestamp()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', LanguageMap::create(array('en-US' => 'test')));
        $object = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $this->beConstructedWith(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'), $actor, $verb, $object, null, null, new \DateTime('2014-07-23T12:34:02-05:00'));

        $otherStatement = new Statement(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'), $actor, $verb, $object, null, null, new \DateTime('2015-07-23T12:34:02-05:00'));

        $this->equals($otherStatement)->shouldBe(false);
    }

    function it_equals_another_statement_with_same_timestamp()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $verb = new Verb('http://tincanapi.com/conformancetest/verbid', LanguageMap::create(array('en-US' => 'test')));
        $object = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $this->beConstructedWith(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'), $actor, $verb, $object, null, null, new \DateTime('2014-07-23T12:34:02-05:00'));

        $otherStatement = new Statement(StatementId::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af'), $actor, $verb, $object, null, null, new \DateTime('2014-07-23T12:34:02-05:00'));

        $this->equals($otherStatement)->shouldBe(true);
    }

    public function it_returns_a_new_instance_with_id()
    {
        $id = StatementId::fromString('12345678-1234-5678-8234-567812345678');
        $statement = $this->withId($id);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getId()->shouldReturn($id);
    }

    public function it_returns_a_new_instance_with_actor()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $statement = $this->withActor($actor);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getActor()->shouldReturn($actor);
    }

    public function it_returns_a_new_instance_with_verb()
    {
        $verb = new Verb('http://adlnet.gov/expapi/verbs/voided');
        $statement = $this->withVerb($verb);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getVerb()->shouldReturn($verb);
    }

    public function it_returns_a_new_instance_with_object()
    {
        $statementReference = new StatementReference(StatementId::fromString('12345678-1234-5678-8234-567812345678'));
        $statement = $this->withObject($statementReference);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getObject()->shouldReturn($statementReference);
    }

    public function it_returns_a_new_instance_with_result()
    {
        $result = new Result();
        $statement = $this->withResult($result);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getResult()->shouldReturn($result);
    }

    public function it_returns_a_new_instance_with_authority()
    {
        $authority = new Agent(InverseFunctionalIdentifier::withOpenId('http://openid.tincanapi.com'));
        $statement = $this->withAuthority($authority);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getAuthority()->shouldReturn($authority);
    }

    public function it_returns_a_new_instance_with_timestamp()
    {
        $timestamp = new \DateTime('2014-07-23T12:34:02-05:00');
        $statement = $this->withTimestamp($timestamp);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getTimestamp()->shouldReturn($timestamp);
    }

    public function it_returns_a_new_instance_with_stored()
    {
        $stored = new \DateTime('2014-07-23T12:34:02-05:00');
        $statement = $this->withStored($stored);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getStored()->shouldReturn($stored);
    }

    public function it_returns_a_new_instance_with_context()
    {
        $context = new Context();
        $statement = $this->withContext($context);

        $statement->shouldNotBe($this);
        $statement->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Statement');
        $statement->getContext()->shouldReturn($context);
    }
}
