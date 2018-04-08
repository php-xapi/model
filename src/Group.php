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
 * A group of {@link Agent Agents} of a {@link Statement}.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class Group extends Actor
{
    /**
     * @var Agent[] The members of the Group
     */
    private $members = array();

    /**
     * @param InverseFunctionalIdentifier $iri
     * @param string                      $name
     * @param Agent[]                     $members
     */
    public function __construct(InverseFunctionalIdentifier $iri = null, $name = null, array $members = array())
    {
        parent::__construct($iri, $name);

        $this->members = $members;
    }

    /**
     * Returns the members of this group.
     *
     * @return Agent[] The members
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(StatementObject $actor)
    {
        if (!parent::equals($actor)) {
            return false;
        }

        /** @var Group $actor */

        if (count($this->members) !== count($actor->members)) {
            return false;
        }

        foreach ($this->members as $member) {
            if (!in_array($member, $actor->members)) {
                return false;
            }
        }

        return true;
    }
}
