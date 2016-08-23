<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\ContextActivities;
use Xabbuh\XApi\Model\Extensions;
use Xabbuh\XApi\Model\Group;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;
use Xabbuh\XApi\Model\StatementReference;

class ContextSpec extends ObjectBehavior
{
    public function its_properties_are_empty_by_default()
    {
        $this->getRegistration()->shouldBeNull();
        $this->getInstructor()->shouldBeNull();
        $this->getTeam()->shouldBeNull();
        $this->getContextActivities()->shouldBeNull();
        $this->getRevision()->shouldBeNull();
        $this->getPlatform()->shouldBeNull();
        $this->getLanguage()->shouldBeNull();
        $this->getStatement()->shouldBeNull();
        $this->getExtensions()->shouldBeNull();
    }

    public function it_returns_a_new_instance_with_registration()
    {
        $context = $this->withRegistration('12345678-1234-5678-8234-567812345678');

        $this->getRegistration()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getRegistration()->shouldReturn('12345678-1234-5678-8234-567812345678');
    }

    public function it_returns_a_new_instance_with_instructor()
    {
        $instructor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $context = $this->withInstructor($instructor);

        $this->getInstructor()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getInstructor()->shouldReturn($instructor);
    }

    public function it_returns_a_new_instance_with_team()
    {
        $team = new Group(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'), 'team');
        $context = $this->withTeam($team);

        $this->getTeam()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getTeam()->shouldReturn($team);
    }

    public function it_returns_a_new_instance_with_context_activities()
    {
        $contextActivities = new ContextActivities();
        $context = $this->withContextActivities($contextActivities);

        $this->getContextActivities()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getContextActivities()->shouldReturn($contextActivities);
    }

    public function it_returns_a_new_instance_with_revision()
    {
        $context = $this->withRevision('test');

        $this->getRevision()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getRevision()->shouldReturn('test');
    }

    public function it_returns_a_new_instance_with_platform()
    {
        $context = $this->withPlatform('test');

        $this->getPlatform()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getPlatform()->shouldReturn('test');
    }

    public function it_returns_a_new_instance_with_language()
    {
        $context = $this->withLanguage('en-US');

        $this->getLanguage()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getLanguage()->shouldReturn('en-US');
    }

    public function it_returns_a_new_instance_with_statement_reference()
    {
        $statementReference = new StatementReference('16fd2706-8baf-433b-82eb-8c7fada847da');
        $context = $this->withStatement($statementReference);

        $this->getStatement()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getStatement()->shouldReturn($statementReference);
    }

    public function it_returns_a_new_instance_with_extensions()
    {
        $extensions = new Extensions(array('http://id.tincanapi.com/extension/topic' => 'Conformance Testing'));
        $context = $this->withExtensions($extensions);

        $this->getExtensions()->shouldBeNull();

        $context->shouldNotBe($this);
        $context->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Context');
        $context->getExtensions()->shouldReturn($extensions);
    }
}
