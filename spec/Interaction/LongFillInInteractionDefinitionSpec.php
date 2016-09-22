<?php

namespace spec\Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Interaction\LongFillInInteractionDefinition;

class LongFillInInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    protected function createEmptyInteraction()
    {
        return new LongFillInInteractionDefinition();
    }
}
