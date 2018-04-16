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
     * @var StatementId|null The unique identifier
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
     * @var StatementObject The {@link StatementObject}
     */
    private $object;

    /**
     * @var Result|null The {@link Activity} {@link Result}
     */
    private $result;

    /**
     * @var Actor|null The Authority that asserted the Statement true
     */
    private $authority;

    /**
     * @var \DateTime|null The timestamp of when the events described in this statement occurred
     */
    private $created;

    /**
     * @var \DateTime|null The timestamp of when this statement was recorded by the LRS
     */
    private $stored;

    /**
     * @var Context|null A context giving the statement more meaning
     */
    private $context;

    private $attachments;

    private $version;

    /**
     * @param StatementId|null  $id
     * @param Actor             $actor
     * @param Verb              $verb
     * @param StatementObject   $object
     * @param Result|null       $result
     * @param Actor|null        $authority
     * @param \DateTime|null    $created
     * @param \DateTime|null    $stored
     * @param Context|null      $context
     * @param Attachment[]|null $attachments
     * @param string|null       $version
     */
    public function __construct(StatementId $id = null, Actor $actor, Verb $verb, StatementObject $object, Result $result = null, Actor $authority = null, \DateTime $created = null, \DateTime $stored = null, Context $context = null, array $attachments = null, string $version = null)
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
        $this->attachments = null !== $attachments ? array_values($attachments) : null;
        $this->version = $version;
    }

    public function withId(StatementId $id = null): self
    {
        $statement = clone $this;
        $statement->id = $id;

        return $statement;
    }

    public function withActor(Actor $actor): self
    {
        $statement = clone $this;
        $statement->actor = $actor;

        return $statement;
    }

    public function withVerb(Verb $verb): self
    {
        $statement = clone $this;
        $statement->verb = $verb;

        return $statement;
    }

    public function withObject(StatementObject $object): self
    {
        $statement = clone $this;
        $statement->object = $object;

        return $statement;
    }

    public function withResult(Result $result = null): self
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
    public function withAuthority(Actor $authority = null): self
    {
        $statement = clone $this;
        $statement->authority = $authority;

        return $statement;
    }

    public function withCreated(\DateTime $created = null): self
    {
        $statement = clone $this;
        $statement->created = $created;

        return $statement;
    }

    public function withStored(\DateTime $stored = null): self
    {
        $statement = clone $this;
        $statement->stored = $stored;

        return $statement;
    }

    public function withContext(Context $context = null): self
    {
        $statement = clone $this;
        $statement->context = $context;

        return $statement;
    }

    /**
     * @param Attachment[]|null $attachments
     *
     * @return self
     */
    public function withAttachments(array $attachments = null): self
    {
        $statement = clone $this;
        $statement->attachments = null !== $attachments ? array_values($attachments) : null;

        return $statement;
    }

    /**
     * @param string $version
     *
     * @return self
     */
    public function withVersion(string $version): self
    {
        $statement = clone $this;
        $statement->version = $version;

        return $statement;
    }

    /**
     * Returns the Statement's unique identifier.
     *
     * @return StatementId|null The identifier
     */
    public function getId(): ?StatementId
    {
        return $this->id;
    }

    /**
     * Returns the Statement's {@link Verb}.
     *
     * @return Verb The Verb
     */
    public function getVerb(): Verb
    {
        return $this->verb;
    }

    /**
     * Returns the Statement's {@link Actor}.
     *
     * @return Actor The Actor
     */
    public function getActor(): Actor
    {
        return $this->actor;
    }

    /**
     * Returns the Statement's {@link StatementObject}.
     *
     * @return StatementObject The Object
     */
    public function getObject(): StatementObject
    {
        return $this->object;
    }

    /**
     * Returns the {@link Activity} {@link Result}.
     *
     * @return Result|null The Result
     */
    public function getResult(): ?Result
    {
        return $this->result;
    }

    /**
     * Returns the Authority that asserted the Statement true.
     *
     * @return Actor|null The Authority
     */
    public function getAuthority(): ?Actor
    {
        return $this->authority;
    }

    /**
     * Returns the timestamp of when the events described in this statement
     * occurred.
     *
     * @return \DateTime|null The timestamp
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * Returns the timestamp of when this statement was recorded by the LRS.
     *
     * @return \DateTime|null The timestamp
     */
    public function getStored(): ?\DateTime
    {
        return $this->stored;
    }

    /**
     * Returns the context that gives the statement more meaning.
     *
     * @return Context|null
     */
    public function getContext(): ?Context
    {
        return $this->context;
    }

    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    public function getVersion(): ?string
    {
        return $this->version;
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
        if (null !== $this->id xor null !== $statement->id) {
            return false;
        }

        if (null !== $this->id && null !== $statement->id && !$this->id->equals($statement->id)) {
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

        if (null !== $this->context xor null !== $statement->context) {
            return false;
        }

        if (null !== $this->context && null !== $statement->context && !$this->context->equals($statement->context)) {
            return false;
        }

        if (null !== $this->attachments xor null !== $statement->attachments) {
            return false;
        }

        if (null !== $this->attachments && null !== $statement->attachments) {
            if (count($this->attachments) !== count($statement->attachments)) {
                return false;
            }

            foreach ($this->attachments as $key => $attachment) {
                if (!$attachment->equals($statement->attachments[$key])) {
                    return false;
                }
            }
        }

        return true;
    }
}
