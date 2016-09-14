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

use Xabbuh\XApi\Common\Exception\UnsupportedOperationException;

/**
 * xAPI statement extensions.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class Extensions implements \ArrayAccess
{
    private $extensions;

    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->extensions[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        if (!isset($this->extensions[$offset])) {
            throw new \InvalidArgumentException(sprintf('No extension for key "%s" registered.', $offset));
        }

        return $this->extensions[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        throw new UnsupportedOperationException('xAPI statement extensions are immutable.');
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        throw new UnsupportedOperationException('xAPI statement extensions are immutable.');
    }

    public function getExtensions()
    {
        return $this->extensions;
    }

    public function equals(Extensions $otherExtensions)
    {
        if (count($this->extensions) !== count($otherExtensions->extensions)) {
            return false;
        }

        foreach ($this->extensions as $key => $value) {
            if (!array_key_exists($key, $otherExtensions->extensions)) {
                return false;
            }

            if ($this->extensions[$key] != $otherExtensions[$key]) {
                return false;
            }
        }

        return true;
    }
}
