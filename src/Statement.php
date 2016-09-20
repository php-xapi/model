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
 * An Experience API {@link https://github.com/adlnet/xAPI-Spec/blob/master/xAPI.md#statement Statement}.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class Statement
{
    /**
     * @var string The unique identifier
     */
    private $id;

    /**
     * @var Verb $verb The {@link Verb}
     */
    private $verb;

    /**
     * @var Actor The {@link Actor}
     */
    private $actor;

    /**
     * @var Object The {@link Object}
     */
    private $object;

    /**
     * @var Result The {@link Activity} {@link Result}
     */
    private $result;

    /**
     * @var Actor The Authority that asserted the Statement true
     */
    private $authority;

    /**
     * @var \DateTime The timestamp of when the events described in this statement occurred
     */
    private $created;

    /**
     * @var \DateTime The timestamp of when this statement was recorded by the LRS
     */
    private $stored;

    /**
     * @var Context|null A context giving the statement more meaning
     */
    private $context;

    public function __construct($id, Actor $actor, Verb $verb, Object $object, Result $result = null, Actor $authority = null, \DateTime $created = null, \DateTime $stored = null, Context $context = null)
    {
        $this->id = $id;
        $this->actor = $actor;
        $this->verb = $verb;
        $this->object = $object;
        $this->result = $result;
        $this->authority = $authority;
        $this->created = $created;
        $this->stored = $stored;
        $this->context = $context;
    }

    /**
     * @param string $id
     *
     * @return Statement
     */
    public function withId($id)
    {
        $statement = clone $this;
        $statement->id = $id;

        return $statement;
    }

    public function withActor(Actor $actor)
    {
        $statement = clone $this;
        $statement->actor = $actor;

        return $statement;
    }

    public function withVerb(Verb $verb)
    {
        $statement = clone $this;
        $statement->verb = $verb;

        return $statement;
    }

    public function withObject(Object $object)
    {
        $statement = clone $this;
        $statement->object = $object;

        return $statement;
    }

    public function withResult(Result $result)
    {
        $statement = clone $this;
        $statement->result = $result;

        return $statement;
    }

    /**
     * Creates a new Statement based on the current one containing an Authority
     * that asserts the Statement true.
     *
     * @param Actor $authority The Authority asserting the Statement true
     *
     * @return Statement The new Statement
     */
    public function withAuthority(Actor $authority)
    {
        $statement = clone $this;
        $statement->authority = $authority;

        return $statement;
    }

    public function withTimestamp(\DateTime $timestamp)
    {
        $statement = clone $this;
        $statement->created = $timestamp;

        return $statement;
    }

    public function withStored(\DateTime $stored)
    {
        $statement = clone $this;
        $statement->stored = $stored;

        return $statement;
    }

    public function withContext(Context $context)
    {
        $statement = clone $this;
        $statement->context = $context;

        return $statement;
    }

    /**
     * Returns the Statement's unique identifier.
     *
     * @return string The identifier
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the Statement's {@link Verb}.
     *
     * @return Verb The Verb
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * Returns the Statement's {@link Actor}.
     *
     * @return Actor The Actor
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Returns the Statement's {@link Object}.
     *
     * @return \Xabbuh\XApi\Model\Object The Object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Returns the {@link Activity} {@link Result}.
     *
     * @return Result The Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Returns the Authority that asserted the Statement true.
     *
     * @return Actor The Authority
     */
    public function getAuthority()
    {
        return $this->authority;
    }

    /**
     * Returns the timestamp of when the events described in this statement
     * occurred.
     *
     * @return \DateTime The timestamp
     */
    public function getTimestamp()
    {
        return $this->created;
    }

    /**
     * Returns the timestamp of when the events described in this statement
     * occurred.
     *
     * @return \DateTime The timestamp
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Returns the timestamp of when this statement was recorded by the LRS.
     *
     * @return \DateTime The timestamp
     */
    public function getStored()
    {
        return $this->stored;
    }

    /**
     * Returns the context that gives the statement more meaning.
     *
     * @return Context|null
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Tests whether or not this Statement is a void Statement (i.e. it voids
     * another Statement).
     *
     * @return bool True if the Statement voids another Statement, false otherwise
     */
    public function isVoidStatement()
    {
        return $this->verb->isVoidVerb();
    }

    /**
     * Returns a {@link StatementReference} for the Statement.
     *
     * @return StatementReference The reference
     */
    public function getStatementReference()
    {
        $reference = new StatementReference($this->id);

        return $reference;
    }

    /**
     * Returns a Statement that voids the current Statement.
     *
     * @param Actor $actor The Actor voiding this Statement
     *
     * @return Statement The voiding Statement
     */
    public function getVoidStatement(Actor $actor)
    {
        return new Statement(
            null,
            $actor,
            Verb::createVoidVerb(),
            $this->getStatementReference()
        );
    }

    /**
     * Checks if another statement is equal.
     *
     * Two statements are equal if and only if all of their properties are equal.
     *
     * @param Statement $statement The statement to compare with
     *
     * @return bool True if the statements are equal, false otherwise
     */
    public function equals(Statement $statement)
    {
        if ($this->id !== $statement->id) {
            return false;
        }

        if (!$this->actor->equals($statement->actor)) {
            return false;
        }

        if (!$this->verb->equals($statement->verb)) {
            return false;
        }

        if (!$this->object->equals($statement->object)) {
            return false;
        }

        if (null === $this->result && null !== $statement->result) {
            return false;
        }

        if (null !== $this->result && null === $statement->result) {
            return false;
        }

        if (null !== $this->result && !$this->result->equals($statement->result)) {
            return false;
        }

        if (null === $this->authority && null !== $statement->authority) {
            return false;
        }

        if (null !== $this->authority && null === $statement->authority) {
            return false;
        }

        if (null !== $this->authority && !$this->authority->equals($statement->authority)) {
            return false;
        }

        if ($this->created != $statement->created) {
            return false;
        }

        return true;
    }
}
