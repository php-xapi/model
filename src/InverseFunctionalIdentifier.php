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
 * The inverse functional identifier of an {@link Actor}.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class InverseFunctionalIdentifier
{
    /**
     * @var string A mailto IRI
     */
    private $mbox;

    /**
     * @var string The SHA1 hash of a mailto IRI
     */
    private $mboxSha1Sum;

    /**
     * @var string An openID uniquely identifying an Agent
     */
    private $openId;

    /**
     * @var Account A user account on an existing system
     */
    private $account;

    /**
     * Use one of the with*() factory methods to obtain an InverseFunctionalIdentifier
     * instance.
     */
    private function __construct()
    {
    }

    public static function withMbox($mbox)
    {
        $iri = new InverseFunctionalIdentifier();
        $iri->mbox = $mbox;

        return $iri;
    }

    public static function withMboxSha1Sum($mboxSha1Sum)
    {
        $iri = new InverseFunctionalIdentifier();
        $iri->mboxSha1Sum = $mboxSha1Sum;

        return $iri;
    }

    public static function withOpenId($openId)
    {
        $iri = new InverseFunctionalIdentifier();
        $iri->openId = $openId;

        return $iri;
    }

    public static function withAccount(Account $account)
    {
        $iri = new InverseFunctionalIdentifier();
        $iri->account = $account;

        return $iri;
    }

    /**
     * Returns the mailto IRI.
     *
     * @return string The mailto IRI
     */
    public function getMbox()
    {
        return $this->mbox;
    }

    /**
     * Returns the SHA1 hash of a mailto IRI.
     *
     * @return string The SHA1 hash of a mailto IRI
     */
    public function getMboxSha1Sum()
    {
        return $this->mboxSha1Sum;
    }

    /**
     * Returns the openID.
     *
     * @return string The openID
     */
    public function getOpenId()
    {
        return $this->openId;
    }

    /**
     * Returns the user account of an existing system.
     *
     * @return Account The user account of an existing system
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Checks if another IRI is equal.
     *
     * Two inverse functional identifiers are equal if and only if all of their
     * properties are equal.
     *
     * @param InverseFunctionalIdentifier $iri The iri to compare with
     *
     * @return bool True if the IRIs are equal, false otherwise
     */
    public function equals(InverseFunctionalIdentifier $iri)
    {
        if ($this->mbox !== $iri->mbox) {
            return false;
        }

        if ($this->mboxSha1Sum !== $iri->mboxSha1Sum) {
            return false;
        }

        if ($this->openId !== $iri->openId) {
            return false;
        }

        if (null === $this->account && null !== $iri->account) {
            return false;
        }

        if (null !== $this->account && null === $iri->account) {
            return false;
        }

        if (null !== $this->account && !$this->account->equals($iri->account)) {
            return false;
        }

        return true;
    }

    public function __toString()
    {
        if (null !== $this->mbox) {
            return $this->mbox;
        }

        if (null !== $this->mboxSha1Sum) {
            return $this->mboxSha1Sum;
        }

        if (null !== $this->openId) {
            return $this->openId;
        }

        return $this->account;
    }
}
