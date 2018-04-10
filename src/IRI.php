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
 * An internationalized resource identifier according to RFC 3987.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class IRI
{
    private $value;

    private function __construct()
    {
    }

    /**
     * @param string $value
     *
     * @return self
     *
     * @throws \InvalidArgumentException if the given value is no valid IRI
     */
    public static function fromString($value)
    {
        $iri = new self();
        $iri->value = $value;

        return $iri;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function equals(IRI $iri)
    {
        return $this->value === $iri->value;
    }
}
