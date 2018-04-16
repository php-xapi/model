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
 * A user account on an existing system.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class Account
{
    /**
     * @var string The unique id or name used to log in to this account
     */
    private $name;

    /**
     * @var IRL Canonical home page for the system the account is on
     */
    private $homePage;

    public function __construct(string $name, IRL $homePage)
    {
        $this->name = $name;
        $this->homePage = $homePage;
    }

    /**
     * Returns the unique id or name used to log in to this account.
     *
     * @return string The user name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the home page for the system the account is on.
     *
     * @return IRL The home page
     */
    public function getHomePage(): IRL
    {
        return $this->homePage;
    }

    /**
     * Checks if another account is equal.
     *
     * Two accounts are equal if and only if all of their properties are equal.
     *
     * @param Account $account The account to compare with
     *
     * @return bool True if the accounts are equal, false otherwise
     */
    public function equals(Account $account): bool
    {
        if ($this->name !== $account->name) {
            return false;
        }

        if (!$this->homePage->equals($account->homePage)) {
            return false;
        }

        return true;
    }
}
