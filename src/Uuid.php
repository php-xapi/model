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

use Ramsey\Uuid\Uuid as RamseyUuid;
use Rhumsaa\Uuid\Uuid as RhumsaaUuid;

/**
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
final class Uuid
{
    /**
     * @var RamseyUuid|RhumsaaUuid;
     */
    private $uuid;

    private function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @param string $uuid
     * @return Uuid
     */
    public static function fromString($uuid)
    {
        if (class_exists('Rhumsaa\Uuid\Uuid')) {
            return new self(RhumsaaUuid::fromString($uuid));
        }

        return new self(RamseyUuid::fromString($uuid));
    }

    public function toString()
    {
        return $this->uuid->toString();
    }

    public function equals(Uuid $uuid)
    {
        return $this->uuid->toString() === $uuid->toString();
    }
}
