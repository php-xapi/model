<?php

namespace spec\Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Interaction\TrueFalseInteractionDefinition;

class TrueFalseInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    protected function createEmptyInteraction()
    {
        return new TrueFalseInteractionDefinition();
    }
}
