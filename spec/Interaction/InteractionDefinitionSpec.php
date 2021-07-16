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

use spec\Xabbuh\XApi\Model\DefinitionSpec;
use Xabbuh\XApi\Model\Definition;
use Xabbuh\XApi\Model\Interaction\InteractionDefinition;

abstract class InteractionDefinitionSpec extends DefinitionSpec
{
    public function it_is_a_definition()
    {
        $this->shouldHaveType(Definition::class);
    }

    public function it_is_an_interaction()
    {
        $this->shouldHaveType(InteractionDefinition::class);
    }

    public function it_is_not_equal_to_generic_definition()
    {
        $this->equals(new Definition())->shouldReturn(false);
    }

    public function it_is_not_equal_if_only_other_interaction_has_correct_responses_pattern()
    {
        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withCorrectResponsesPattern(['test']);

        $this->equals($interaction)->shouldReturn(false);
    }

    public function it_is_not_equal_if_only_this_interaction_has_correct_responses_pattern()
    {
        $this->beConstructedWith(null, null, null, null, null, ['test']);

        $this->equals($this->createEmptyDefinition())->shouldReturn(false);
    }

    public function it_is_not_equal_if_number_of_correct_responses_pattern_differs()
    {
        $this->beConstructedWith(null, null, null, null, null, ['test']);

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withCorrectResponsesPattern(['test', 'foo']);

        $this->equals($interaction)->shouldReturn(false);
    }

    public function it_is_not_equal_if_correct_responses_pattern_values_differ()
    {
        $this->beConstructedWith(null, null, null, null, null, ['foo']);

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withCorrectResponsesPattern(['bar']);

        $this->equals($interaction)->shouldReturn(false);
    }

    public function it_is_equal_if_correct_responses_pattern_values_are_equal()
    {
        $this->beConstructedWith(null, null, null, null, null, ['test']);

        $interaction = $this->createEmptyDefinition();
        $interaction = $interaction->withCorrectResponsesPattern(['test']);

        $this->equals($interaction)->shouldReturn(true);
    }
}
