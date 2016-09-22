<?php

namespace spec\Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Interaction\OtherInteractionDefinition;

class OtherInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    protected function createEmptyInteraction()
    {
        return new OtherInteractionDefinition();
    }
}
