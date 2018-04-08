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

use Xabbuh\XApi\Model\Interaction\OtherInteractionDefinition;

class OtherInteractionDefinitionSpec extends InteractionDefinitionSpec
{
    protected function createEmptyDefinition()
    {
        return new OtherInteractionDefinition();
    }
}
