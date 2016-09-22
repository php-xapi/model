<?php

namespace spec\Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Interaction\ChoiceInteractionDefinition;
use Xabbuh\XApi\Model\Interaction\InteractionComponent;

class ChoiceInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    public function it_returns_a_new_instance_with_choices()
    {
        $choices = array(new InteractionComponent('test'));
        $interaction = $this->withChoices($choices);

        $this->getChoices()->shouldBeNull();

        $interaction->shouldNotBe($this);
        $interaction->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\Interaction\ChoiceInteractionDefinition');
        $interaction->getChoices()->shouldReturn($choices);
    }

    function it_is_not_equal_if_only_other_interaction_has_choices()
    {
        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withChoices(array(new InteractionComponent('test')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_only_this_interaction_has_choices()
    {
        $this->beConstructedWith(null, null, null, null, null, array(new InteractionComponent('test')));

        $this->equals($this->createEmptyInteraction())->shouldReturn(false);
    }

    function it_is_not_equal_if_number_of_choices_differs()
    {
        $this->beConstructedWith(null, null, null, null, null, array(new InteractionComponent('test')));

        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withChoices(array(new InteractionComponent('test'), new InteractionComponent('foo')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_not_equal_if_choices_differ()
    {
        $this->beConstructedWith(null, null, null, null, null, array(new InteractionComponent('foo')));

        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withChoices(array(new InteractionComponent('bar')));

        $this->equals($interaction)->shouldReturn(false);
    }

    function it_is_equal_if_choices_are_equal()
    {
        $this->beConstructedWith(null, null, null, null, null, array(new InteractionComponent('test')));

        $interaction = $this->createEmptyInteraction();
        $interaction = $interaction->withChoices(array(new InteractionComponent('test')));

        $this->equals($interaction)->shouldReturn(true);
    }

    protected function createEmptyInteraction()
    {
        return new ChoiceInteractionDefinition();
    }
}
