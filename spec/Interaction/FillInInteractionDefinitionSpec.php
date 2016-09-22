<?php

namespace spec\Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Interaction\FillInInteractionDefinition;

class FillInInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    protected function createEmptyInteraction()
    {
        return new FillInInteractionDefinition();
    }
}
