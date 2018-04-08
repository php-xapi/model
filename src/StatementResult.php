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
 * Result when querying a Learning Record Store (LRS) for a list of
 * {@link Statement Statements}.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class StatementResult
{
    /**
     * @var Statement[] The collection of Statements
     */
    private $statements;

    /**
     * @var IRL|null
     */
    private $moreUrlPath;

    /**
     * @param Statement[] $statements  The collection of Statements
     * @param IRL|null    $moreUrlPath The URL path
     */
    public function __construct(array $statements, IRL $moreUrlPath = null)
    {
        $this->statements = $statements;
        $this->moreUrlPath = $moreUrlPath;
    }

    /**
     * Returns the Statements.
     *
     * @return Statement[] The Statements
     */
    public function getStatements()
    {
        return $this->statements;
    }

    /**
     * Relative IRL that can be used to retrieve the next results.
     *
     * @return IRL|null The URL path
     */
    public function getMoreUrlPath()
    {
        return $this->moreUrlPath;
    }
}
