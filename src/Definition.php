<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Model;

/**
 * Definition of an {@link Activity}.
 *
 * A number of derived classes exists each of them covering a specialized
 * type of user interaction:
 *
 * <ul>
 *   <li>ChoiceInteractionDefinition</li>
 *   <li>FillInteractionDefinition</li>
 *   <li>LikertInteractionDefinition</li>
 *   <li>LongFillInInteractionDefinition</li>
 *   <li>MatchingInteractionDefinition</li>
 *   <li>NumericInteractionDefinition</li>
 *   <li>PerformanceInteractionDefinition</li>
 *   <li>OtherInteractionDefinition</li>
 *   <li>SequencingInteractionDefinition</li>
 *   <li>TrueFalseInteractionDefinition</li>
 * </ul>
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class Definition
{
    /**
     * The human readable activity name
     * @var LanguageMap|null
     */
    private $name;

    /**
     * The human readable activity description
     * @var LanguageMap|null
     */
    private $description;

    /**
     * The type of the {@link Activity}
     * @var string|null
     */
    private $type;

    /**
     * An IRL where human-readable information describing the {@link Activity} can be found.
     *
     * @var string|null
     */
    private $moreInfo;

    /**
     * Extensions associated with the {@link Activity}.
     *
     * @var Extensions|null
     */
    private $extensions;

    /**
     * @param LanguageMap|null $name
     * @param LanguageMap|null $description
     * @param string|null      $type
     * @param string|null      $moreInfo
     * @param Extensions|null  $extensions
     */
    public function __construct(LanguageMap $name = null, LanguageMap $description = null, $type = null, $moreInfo = null, Extensions $extensions = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->moreInfo = $moreInfo;
        $this->extensions = $extensions;
    }

    public function withName(LanguageMap $name = null)
    {
        $definition = clone $this;
        $definition->name = $name;

        return $definition;
    }

    public function withDescription(LanguageMap $description = null)
    {
        $definition = clone $this;
        $definition->description = $description;

        return $definition;
    }

    /**
     * @param string|null $type
     *
     * @return static
     */
    public function withType($type)
    {
        $definition = clone $this;
        $definition->type = $type;

        return $definition;
    }

    /**
     * @param string|null $moreInfo
     *
     * @return static
     */
    public function withMoreInfo($moreInfo)
    {
        $definition = clone $this;
        $definition->moreInfo = $moreInfo;

        return $definition;
    }

    public function withExtensions(Extensions $extensions)
    {
        $definition = clone $this;
        $definition->extensions = $extensions;

        return $definition;
    }

    /**
     * Returns the human readable names.
     *
     * @return LanguageMap|null The name language map
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the human readable descriptions.
     *
     * @return LanguageMap|null The description language map
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the {@link Activity} type.
     *
     * @return string|null The type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns an IRL where human-readable information about the activity can be found.
     *
     * @return string|null
     */
    public function getMoreInfo()
    {
        return $this->moreInfo;
    }

    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Checks if another definition is equal.
     *
     * Two definitions are equal if and only if all of their properties are equal.
     *
     * @param Definition $definition The definition to compare with
     *
     * @return bool True if the definitions are equal, false otherwise
     */
    public function equals(Definition $definition)
    {
        if (get_class($this) !== get_class($definition)) {
            return false;
        }

        if ($this->type !== $definition->type) {
            return false;
        }

        if ($this->moreInfo !== $definition->moreInfo) {
            return false;
        }

        if (null !== $this->extensions xor null !== $definition->extensions) {
            return false;
        }

        if (count($this->name) !== count($definition->name)) {
            return false;
        }

        if (count($this->description) !== count($definition->description)) {
            return false;
        }

        if (!is_array($this->name) xor !is_array($definition->name)) {
            return false;
        }

        if (!is_array($this->description) xor !is_array($definition->description)) {
            return false;
        }

        if (is_array($this->name)) {
            foreach ($this->name as $language => $value) {
                if (!isset($definition->name[$language])) {
                    return false;
                }

                if ($value !== $definition->name[$language]) {
                    return false;
                }
            }
        }

        if (is_array($this->description)) {
            foreach ($this->description as $language => $value) {
                if (!isset($definition->description[$language])) {
                    return false;
                }

                if ($value !== $definition->description[$language]) {
                    return false;
                }
            }
        }

        if (null !== $this->extensions && null !== $definition->extensions && !$this->extensions->equals($definition->extensions)) {
            return false;
        }

        return true;
    }
}
