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
 * An {@link Actor Actor's} outcome related to the {@link Statement} in which
 * it is included.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class Result
{
    /**
     * @var Score The score
     */
    private $score;

    /**
     * @var bool Indicates whether or not the attempt was successful
     */
    private $success;

    /**
     * @var bool Indicates whether or not the Activity was completed
     */
    private $completion;

    /**
     * @var string A response for the given Activity
     */
    private $response;

    /**
     * @var string Period of time over which the Activity was performed
     */
    private $duration;

    /**
     * @var Extensions|null Extensions associated with this result
     */
    private $extensions;

    /**
     * @param Score|null      $score
     * @param bool|null       $success
     * @param bool|null       $completion
     * @param string|null     $response
     * @param string|null     $duration
     * @param Extensions|null $extensions
     */
    public function __construct(Score $score = null, $success = null, $completion = null, $response = null, $duration = null, Extensions $extensions = null)
    {
        $this->score = $score;
        $this->success = $success;
        $this->completion = $completion;
        $this->response = $response;
        $this->duration = $duration;
        $this->extensions = $extensions;
    }

    /**
     * Returns the user's score.
     *
     * @return Score The score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Returns whether or not the user finished a task successfully.
     *
     * @return bool True if the user finished an exercise successfully, false
     *              otherwise
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Returns the completion status.
     *
     * @return bool $completion True, if the Activity was completed, false
     *                          otherwise
     */
    public function getCompletion()
    {
        return $this->completion;
    }

    /**
     * Returns the response.
     *
     * @return string The response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Returns the period of time over which the Activity was performed.
     *
     * @return string The duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Returns the extensions associated with the result.
     *
     * @return Extensions|null The extensions
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Checks if another result is equal.
     *
     * Two results are equal if and only if all of their properties are equal.
     *
     * @param Result $result The result to compare with
     *
     * @return bool True if the results are equal, false otherwise
     */
    public function equals(Result $result)
    {
        if (null !== $this->score xor null !== $result->score) {
            return false;
        }

        if (null !== $this->score && !$this->score->equals($result->score)) {
            return false;
        }

        if ($this->success !== $result->success) {
            return false;
        }

        if ($this->completion !== $result->completion) {
            return false;
        }

        if ($this->response !== $result->response) {
            return false;
        }

        if ($this->duration !== $result->duration) {
            return false;
        }

        if (null !== $this->extensions xor null !== $result->extensions) {
            return false;
        }

        if (null !== $this->extensions && null !== $result->extensions && !$this->extensions->equals($result->extensions)) {
            return false;
        }

        return true;
    }
}
