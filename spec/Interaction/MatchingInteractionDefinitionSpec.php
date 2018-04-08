<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Interaction\InteractionComponent;
use Xabbuh\XApi\Model\Interaction\MatchingInteractionDefinition;

class MatchingInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    public function it_returns_a_new_instance_with_source()
    {
        $source = array(new InteractionComponent('test'));
        $interaction = $this->withSource($source);

        $this->getSource()->shouldBeNull();

        $interaction->shouldNotBe($this);
        $interaction->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Interaction\MatchingInteractionDefinition');
        $interaction->getSource()->shouldReturn($source);
    }

    public function it_returns_a_new_instance_with_target()
    {
        $target = array(new InteractionComponent('test'));
        $interaction = $this->withTarget($target);

        $this->getTarget()->shouldBeNull();

        $interaction->shouldNotBe($this);
        $interaction->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Interaction\MatchingInteractionDefinition');
        $interaction->getTarget()->shouldReturn($target);
    }

    function it_is_not_equal_if_only_other_interaction_has_source()
    {
        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withSource(array(new InteractionComponent('test')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_only_this_interaction_has_source()
    {
        $this->beConstructedWith(null, null, null, null, null, null, array(new InteractionComponent('test')));

        $this->equals($this->createEmptyDefinition())->shouldReturn(false);
    }

    function it_is_not_equal_if_number_of_source_differs()
    {
        $this->beConstructedWith(null, null, null, null, null, null, array(new InteractionComponent('test')));

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withSource(array(new InteractionComponent('test'), new InteractionComponent('foo')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_source_differ()
    {
        $this->beConstructedWith(null, null, null, null, null, null, array(new InteractionComponent('foo')));

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withSource(array(new InteractionComponent('bar')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_equal_if_sources_are_equal()
    {
        $this->beConstructedWith(null, null, null, null, null, null, array(new InteractionComponent('test')));

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withSource(array(new InteractionComponent('test')));

        $this->equals($interaction)->shouldReturn(true);
    }

    function it_is_not_equal_if_only_other_interaction_has_target()
    {
        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withTarget(array(new InteractionComponent('test')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_only_this_interaction_has_target()
    {
        $this->beConstructedWith(null, null, null, null, null, null, null, array(new InteractionComponent('test')));

        $this->equals($this->createEmptyDefinition())->shouldReturn(false);
    }

    function it_is_not_equal_if_number_of_target_differs()
    {
        $this->beConstructedWith(null, null, null, null, null, null, null, array(new InteractionComponent('test')));

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withTarget(array(new InteractionComponent('test'), new InteractionComponent('foo')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_target_differ()
    {
        $this->beConstructedWith(null, null, null, null, null, null, null, array(new InteractionComponent('foo')));

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withTarget(array(new InteractionComponent('bar')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_equal_if_targets_are_equal()
    {
        $this->beConstructedWith(null, null, null, null, null, null, null, array(new InteractionComponent('test')));

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withTarget(array(new InteractionComponent('test')));

        $this->equals($interaction)->shouldReturn(true);
    }

    protected function createEmptyDefinition()
    {
        return new MatchingInteractionDefinition();
    }
}
