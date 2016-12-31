<?php

namespace Xabbuh\XApi\Model;

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
