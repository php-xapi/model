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
 * The Actor of a {@link Statement}.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
abstract class Actor
{
    /**
     * The actor's {@link InverseFunctionalIdentifier inverse functional identifier}
     *
     * @var InverseFunctionalIdentifier
     */
    private $iri;

    /**
     * Name of the {@link Agent} or {@link Group}
     * @var string
     */
    private $name;

    /**
     * @param InverseFunctionalIdentifier $iri
     * @param string                      $name
     */
    public function __construct(InverseFunctionalIdentifier $iri = null, $name = null)
    {
        $this->iri = $iri;
        $this->name = $name;
    }

    /**
     * Returns the Actor's {@link InverseFunctionalIdentifier inverse functional identifier}.
     *
     * @return InverseFunctionalIdentifier The inverse functional identifier
     */
    public function getInverseFunctionalIdentifier()
    {
        return $this->iri;
    }

    /**
     * Returns the name of the {@link Agent} or {@link Group}.
     *
     * @return string The name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Checks if another actor is equal.
     *
     * Two actors are equal if and only if all of their properties are equal.
     *
     * @param Actor $actor The actor to compare with
     *
     * @return bool True if the actors are equal, false otherwise
     */
    public function equals(Actor $actor)
    {
        if ($this->name !== $actor->name) {
            return false;
        }

        if (null !== $this->iri xor null !== $actor->iri) {
            return false;
        }

        if (null !== $this->iri && !$this->iri->equals($actor->getInverseFunctionalIdentifier())) {
            return false;
        }

        return true;
    }
}
