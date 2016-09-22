<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Model\Interaction;

use Xabbuh\XApi\Model\Definition;
use Xabbuh\XApi\Model\LanguageMap;

/**
 * An interaction where the learner is asked to match items in one set
 * (the source set) to items in another set (the target set).
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class MatchingInteractionDefinition extends InteractionDefinition
{
    private $source;
    private $target;

    /**
     * @param LanguageMap|null            $name
     * @param LanguageMap|null            $description
     * @param string|null                 $type
     * @param string|null                 $moreInfo
     * @param string[]|null               $correctResponsesPattern
     * @param InteractionComponent[]|null $source
     * @param InteractionComponent[]|null $target
     */
    public function __construct(LanguageMap $name = null, LanguageMap $description = null, $type = null, $moreInfo = null, array $correctResponsesPattern = null, array $source = null, array $target = null)
    {
        parent::__construct($name, $description, $type, $moreInfo, $correctResponsesPattern);

        $this->source = $source;
        $this->target = $target;
    }

    /**
     * @param InteractionComponent[]|null $source
     *
     * @return static
     */
    public function withSource(array $source = null)
    {
        $interaction = clone $this;
        $interaction->source = $source;

        return $interaction;
    }

    /**
     * @param InteractionComponent[]|null $target
     *
     * @return static
     */
    public function withTarget(array $target = null)
    {
        $interaction = clone $this;
        $interaction->target = $target;

        return $interaction;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function equals(Definition $definition)
    {
        if (!parent::equals($definition)) {
            return false;
        }

        if (!$definition instanceof MatchingInteractionDefinition) {
            return false;
        }

        if (null !== $this->source xor null !== $definition->source) {
            return false;
        }

        if (null !== $this->target xor null !== $definition->target) {
            return false;
        }

        if (null !== $this->source) {
            if (count($this->source) !== count($definition->source)) {
                return false;
            }

            foreach ($this->source as $key => $source) {
                if (!isset($definition->source[$key])) {
                    return false;
                }

                if (!$source->equals($definition->source[$key])) {
                    return false;
                }
            }
        }

        if (null !== $this->target) {
            if (count($this->target) !== count($definition->target)) {
                return false;
            }

            foreach ($this->target as $key => $target) {
                if (!isset($definition->target[$key])) {
                    return false;
                }

                if (!$target->equals($definition->target[$key])) {
                    return false;
                }
            }
        }

        return true;
    }
}
