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
 * Filter to apply on GET requests to the statements API.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class StatementsFilter
{
    /**
     * @var array The generated filter
     */
    private $filter = array();

    /**
     * Filters by an Agent or an identified Group.
     *
     * @param Actor $actor The Actor to filter by
     *
     * @return self The statements filter
     */
    public function byActor(Actor $actor)
    {
        $this->filter['agent'] = $actor;

        return $this;
    }

    /**
     * Filters by a verb.
     *
     * @param Verb $verb The Verb to filter by
     *
     * @return self The statements filter
     */
    public function byVerb(Verb $verb)
    {
        $this->filter['verb'] = $verb->getId()->getValue();

        return $this;
    }

    /**
     * Filter by an Activity.
     *
     * @param Activity $activity The Activity to filter by
     *
     * @return self The statements filter
     */
    public function byActivity(Activity $activity)
    {
        $this->filter['activity'] = $activity->getId()->getValue();

        return $this;
    }

    /**
     * Filters for Statements matching the given registration id.
     *
     * @param string $registration A registration id
     *
     * @return self The statements filter
     */
    public function byRegistration($registration)
    {
        $this->filter['registration'] = $registration;

        return $this;
    }

    /**
     * Applies the Activity filter to Sub-Statements.
     *
     * @return self The statements filter
     */
    public function enableRelatedActivityFilter()
    {
        $this->filter['related_activities'] = 'true';

        return $this;
    }

    /**
     * Don't apply the Activity filter to Sub-Statements.
     *
     * @return self The statements filter
     */
    public function disableRelatedActivityFilter()
    {
        $this->filter['related_activities'] = 'false';

        return $this;
    }

    /**
     * Applies the Agent filter to Sub-Statements.
     *
     * @return self The statements filter
     */
    public function enableRelatedAgentFilter()
    {
        $this->filter['related_agents'] = 'true';

        return $this;
    }

    /**
     * Don't apply the Agent filter to Sub-Statements.
     *
     * @return self The statements filter
     */
    public function disableRelatedAgentFilter()
    {
        $this->filter['related_agents'] = 'false';

        return $this;
    }

    /**
     * Filters for Statements stored since the specified timestamp (exclusive).
     *
     * @param \DateTime $timestamp The timestamp
     *
     * @return self The statements filter
     */
    public function since(\DateTime $timestamp)
    {
        $this->filter['since'] = $timestamp->format('c');

        return $this;
    }

    /**
     * Filters for Statements stored at or before the specified timestamp.
     *
     * @param \DateTime $timestamp The timestamp as a unix timestamp
     *
     * @return self The statements filter
     */
    public function until(\DateTime $timestamp)
    {
        $this->filter['until'] = $timestamp->format('c');

        return $this;
    }

    /**
     * Sets the maximum number of Statements to return. The server side sets
     * the maximum number of results when this value is not set or when it is 0.
     *
     * @param int $limit Maximum number of Statements to return
     *
     * @return self The statements filter
     *
     * @throws \InvalidArgumentException if the limit is not a non-negative
     *                                   integer
     */
    public function limit($limit)
    {
        if ($limit < 0) {
            throw new \InvalidArgumentException('Limit must be a non-negative integer');
        }

        $this->filter['limit'] = $limit;

        return $this;
    }

    /**
     * Return statements in ascending order of stored time.
     *
     * @return self The statements filter
     */
    public function ascending()
    {
        $this->filter['ascending'] = 'true';

        return $this;
    }

    /**
     *Return statements in descending order of stored time (the default behavior).
     *
     * @return self The statements filter
     */
    public function descending()
    {
        $this->filter['ascending'] = 'false';

        return $this;
    }

    /**
     * Returns the generated filter.
     *
     * @return array The filter
     */
    public function getFilter()
    {
        return $this->filter;
    }
}
