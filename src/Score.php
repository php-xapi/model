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
 * The outcome of an {@link Activity} achieved by an {@link Agent}.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class Score
{
    /**
     * @var float The scaled score (a number between -1 and 1)
     */
    private $scaled;

    /**
     * @var float The Agent's score (a number between min and max)
     */
    private $raw;

    /**
     * @var float The minimum score being possible
     */
    private $min;

    /**
     * @var float The maximum score being possible
     */
    private $max;

    /**
     * @param float $scaled
     * @param float $raw
     * @param float $min
     * @param float $max
     */
    public function __construct($scaled = null, $raw = null, $min = null, $max = null)
    {
        $this->scaled = $scaled;
        $this->raw = $raw;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param float $scaled
     *
     * @return Score
     */
    public function withScaled($scaled)
    {
        $score = clone $this;
        $score->scaled = $scaled;

        return $score;
    }

    /**
     * @param float $raw
     *
     * @return Score
     */
    public function withRaw($raw)
    {
        $score = clone $this;
        $score->raw = $raw;

        return $score;
    }

    /**
     * @param float $min
     *
     * @return Score
     */
    public function withMin($min)
    {
        $score = clone $this;
        $score->min = $min;

        return $score;
    }

    /**
     * @param float $max
     *
     * @return Score
     */
    public function withMax($max)
    {
        $score = clone $this;
        $score->max = $max;

        return $score;
    }

    /**
     * Returns the Agent's scaled score (a number between -1 and 1).
     *
     * @return float The scaled score
     */
    public function getScaled()
    {
        return $this->scaled;
    }

    /**
     * Returns the Agent's score.
     *
     * @return float The score
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * Returns the lowest possible score.
     *
     * @return float The lowest possible score
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Returns the highest possible score.
     *
     * @return float The highest possible score
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Checks if another score is equal.
     *
     * Two scores are equal if and only if all of their properties are equal.
     *
     * @param Score $score The score to compare with
     *
     * @return bool True if the scores are equal, false otherwise
     */
    public function equals(Score $score)
    {
        if (null !== $this->scaled xor null !== $score->scaled) {
            return false;
        }

        if ((float) $this->scaled !== (float) $score->scaled) {
            return false;
        }

        if (null !== $this->raw xor null !== $score->raw) {
            return false;
        }

        if ((float) $this->raw !== (float) $score->raw) {
            return false;
        }

        if (null !== $this->min xor null !== $score->min) {
            return false;
        }

        if ((float) $this->min !== (float) $score->min) {
            return false;
        }

        if (null !== $this->max xor null !== $score->max) {
            return false;
        }

        if ((float) $this->max !== (float) $score->max) {
            return false;
        }

        return true;
    }
}
