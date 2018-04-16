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
 * An Activity in a {@link Statement}.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class Activity extends StatementObject
{
    /**
     * @var IRI The Activity's unique identifier
     */
    private $id;

    /**
     * @var Definition|null The Activity's {@link Definition}
     */
    private $definition;

    /**
     * @param IRI             $id
     * @param Definition|null $definition
     */
    public function __construct(IRI $id, Definition $definition = null)
    {
        $this->id = $id;
        $this->definition = $definition;
    }

    /**
     * Returns the Activity's unique identifier.
     *
     * @return IRI The identifier
     */
    public function getId(): IRI
    {
        return $this->id;
    }

    /**
     * Returns the Activity's {@link Definition}.
     *
     * @return Definition|null The Definition
     */
    public function getDefinition(): ?Definition
    {
        return $this->definition;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(StatementObject $object): bool
    {
        if ('Xabbuh\XApi\Model\Activity' !== get_class($object)) {
            return false;
        }

        /** @var Activity $object */

        if (!$this->id->equals($object->id)) {
            return false;
        }

        if (null === $this->definition && null !== $object->definition) {
            return false;
        }

        if (null !== $this->definition && null === $object->definition) {
            return false;
        }

        if (null !== $this->definition && !$this->definition->equals($object->definition)) {
            return false;
        }

        return true;
    }
}
