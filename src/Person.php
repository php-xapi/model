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
 * Combined informations from multiple {@link Agent agents}.
 *
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
final class Person
{
    /**
     * @var string[] List of names of Agents
     */
    private $names = array();

    /**
     * @var IRI[] List of mailto IRIs of Agents
     */
    private $mboxes = array();

    /**
     * @var string[] List of the SHA1 hashes of mailto IRIs of Agents
     */
    private $mboxSha1Sums = array();

    /**
     * @var string[] List of openids that uniquely identify the Agents
     */
    private $openIds = array();

    /**
     * @var Account[] List of accounts of Agents
     */
    private $accounts = array();

    private function __construct()
    {
    }

    /**
     * @param Agent[] $agents
     */
    public static function createFromAgents(array $agents)
    {
        $person = new self();

        foreach ($agents as $agent) {
            $iri = $agent->getInverseFunctionalIdentifier();

            if (null !== $mbox = $iri->getMbox()) {
                $person->mboxes[] = $mbox;
            }

            if (null !== $mboxSha1Sum = $iri->getMboxSha1Sum()) {
                $person->mboxSha1Sums[] = $mboxSha1Sum;
            }

            if (null !== $openId = $iri->getOpenId()) {
                $person->openIds[] = $openId;
            }

            if (null !== $account = $iri->getAccount()) {
                $person->accounts[] = $account;
            }

            if (null !== $name = $agent->getName()) {
                $person->names[] = $name;
            }
        }

        return $person;
    }

    public function getNames()
    {
        return $this->names;
    }

    public function getMboxes($param)
    {
        return $this->mboxes;
    }

    public function getMboxSha1Sums()
    {
        return $this->mboxSha1Sums;
    }

    public function getOpenIds()
    {
        return $this->openIds;
    }

    public function getAccounts()
    {
        return $this->accounts;
    }
}
