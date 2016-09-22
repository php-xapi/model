<?php

namespace spec\Xabbuh\XApi\Model\Interaction;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Definition;
use Xabbuh\XApi\Model\Interaction\InteractionDefinition;

abstract class InteractionDefinitionSpec extends ObjectBehavior
{
    function it_is_a_definition()
    {
        $this->shouldHaveType('Xabbuh\XApi\Model\Definition');
    }

    function it_is_an_interaction()
    {
        $this->shouldHaveType('Xabbuh\XApi\Model\Interaction\InteractionDefinition');
    }

    function it_is_not_equal_to_generic_definition()
    {
        $this->equals(new Definition())->shouldReturn(false);
    }

    function it_is_not_equal_if_only_other_interaction_has_correct_responses_pattern()
    {
        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withCorrectResponsesPattern(array('test'));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_only_this_interaction_has_correct_responses_pattern()
    {
        $this->beConstructedWith(null, null, null, null, array('test'));

        $this->equals($this->createEmptyInteraction())->shouldReturn(false);
    }

    function it_is_not_equal_if_number_of_correct_responses_pattern_differs()
    {
        $this->beConstructedWith(null, null, null, null, array('test'));

        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withCorrectResponsesPattern(array('test', 'foo'));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_correct_responses_pattern_values_differ()
    {
        $this->beConstructedWith(null, null, null, null, array('foo'));

        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withCorrectResponsesPattern(array('bar'));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_equal_if_correct_responses_pattern_values_are_equal()
    {
        $this->beConstructedWith(null, null, null, null, array('test'));

        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withCorrectResponsesPattern(array('test'));

        $this->equals($interaction)->shouldReturn(true);
    }

    /**
     * @return InteractionDefinition
     */
    abstract protected function createEmptyInteraction();
}
