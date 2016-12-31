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
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
final class Uuid
{
    private function __construct()
    {
    }

    /**
     * @param string $uuid
     * @return \Rhumsaa\Uuid\Uuid|\Ramsey\Uuid\Uuid
     */
    public static function fromString($uuid)
    {
        if (class_exists('Rhumsaa\Uuid\Uuid')) {
            return \Rhumsaa\Uuid\Uuid::fromString($uuid);
        }

        return \Ramsey\Uuid\Uuid::fromString($uuid);
    }
}
