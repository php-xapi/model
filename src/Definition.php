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
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class Definition
{
    /**
     * The human readable activity name
     * @var array
     */
    protected $name;

    /**
     * The human readable activity description
     * @var array
     */
    protected $description;

    /**
     * The type of the {@link Activity}
     * @var string
     */
    protected $type;

    public function __construct(array $name, array $description, $type)
    {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
    }

    /**
     * Sets human readable names.
     *
     * @param array $name The name language map
     */
    public function setName(array $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the human readable names.
     *
     * @return array The name language map
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets human readable descriptions.
     *
     * @param array $description The description language map
     */
    public function setDescription(array $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the human readable descriptions.
     *
     * @return array The description language map
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the {@link Activity} type.
     *
     * @param string $type The type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the {@link Activity} type.
     *
     * @return string The type
     */
    public function getType()
    {
        return $this->type;
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
        if ($this->type !== $definition->type) {
            return false;
        }

        if (count($this->name) !== count($definition->name)) {
            return false;
        }

        if (count($this->description) !== count($definition->description)) {
            return false;
        }

        foreach ($this->name as $language => $value) {
            if (!isset($definition->name[$language])) {
                return false;
            }

            if ($value !== $definition->name[$language]) {
                return false;
            }
        }

        foreach ($this->description as $language => $value) {
            if (!isset($definition->description[$language])) {
                return false;
            }

            if ($value !== $definition->description[$language]) {
                return false;
            }
        }

        return true;
    }
}
