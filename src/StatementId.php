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

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * An Experience API {@link https://github.com/adlnet/xAPI-Spec/blob/master/xAPI.md#statement Statement} identifier.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class StatementId
{
    /** @var UuidInterface */
    private $uuid;

    private function __construct()
    {
    }

    public static function fromUuid(UuidInterface $uuid): self
    {
        $id = new self();
        $id->uuid = $uuid;

        return $id;
    }

    /**
     * Creates a statement id based on the given UUID string.
     *
     * @throws \InvalidArgumentException when the given id is not a well-formed UUID
     */
    public static function fromString(string $id): self
    {
        return self::fromUuid(Uuid::fromString($id));
    }

    public function getValue(): string
    {
        return $this->uuid->toString();
    }

    public function equals(StatementId $id): bool
    {
        return $this->uuid->equals($id->uuid);
    }
}
