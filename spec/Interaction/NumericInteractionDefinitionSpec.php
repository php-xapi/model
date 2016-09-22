<?php

namespace spec\Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Interaction\NumericInteractionDefinition;

class NumericInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    protected function createEmptyInteraction()
    {
        return new NumericInteractionDefinition();
    }
}
