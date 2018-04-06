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

use Xabbuh\XApi\Model\Exception\InvalidStateException;

/*
 * Statement factory eases the creation of complex xAPI statements.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class StatementFactory
{
    private $id;
    private $actor;
    private $verb;
    private $object;
    private $result;
    private $context;
    private $created;
    private $stored;
    private $authority;

    public function withId(StatementId $id)
    {
        $this->id = $id;
    }

    public function withActor(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function withVerb(Verb $verb)
    {
        $this->verb = $verb;
    }

    public function withObject(StatementObject $object)
    {
        $this->object = $object;
    }

    public function withResult(Result $result = null)
    {
        $this->result = $result;
    }

    public function withContext(Context $context = null)
    {
        $this->context = $context;
    }

    public function withCreated(\DateTime $created = null)
    {
        $this->created = $created;
    }

    public function withStored(\DateTime $stored = null)
    {
        $this->stored = $stored;
    }

    public function withAuthority(Actor $authority = null)
    {
        $this->authority = $authority;
    }

    /**
     * Returns a statement based on the current configuration.
     *
     * Multiple calls to this method will return different instances.
     *
     * @return Statement
     *
     * @throws InvalidStateException
     */
    public function createStatement()
    {
        if (null === $this->actor) {
            throw new InvalidStateException('A statement actor is missing.');
        }

        if (null === $this->verb) {
            throw new InvalidStateException('A statement verb is missing.');
        }

        if (null === $this->object) {
            throw new InvalidStateException('A statement object is missing.');
        }

        return new Statement($this->id, $this->actor, $this->verb, $this->object, $this->result, $this->authority, $this->created, $this->stored, $this->context);
    }
}
