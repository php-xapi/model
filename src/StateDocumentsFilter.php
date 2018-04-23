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
 * Filter to apply on GET requests to the states API.
 *
 * @author Jérôme Parmentier <jerome.parmentier@acensi.fr>
 */
class StateDocumentsFilter
{
    /**
     * @var array The generated filter
     */
    private $filter = array();

    /**
     * Filter by an Activity.
     *
     * @param Activity $activity The Activity to filter by
     *
     * @return $this
     */
    public function byActivity(Activity $activity)
    {
        $this->filter['activity'] = $activity->getId()->getValue();

        return $this;
    }

    /**
     * Filters by an Agent.
     *
     * @param Agent $agent The Agent to filter by
     *
     * @return $this
     */
    public function byAgent(Agent $agent)
    {
        $this->filter['agent'] = $agent;

        return $this;
    }

    /**
     * Filters for State documents matching the given registration id.
     *
     * @param string $registration A registration id
     *
     * @return $this
     */
    public function byRegistration($registration)
    {
        $this->filter['registration'] = $registration;

        return $this;
    }

    /**
     * Filters for State documents stored since the specified timestamp (exclusive).
     *
     * @param \DateTime $timestamp The timestamp
     *
     * @return $this
     */
    public function since(\DateTime $timestamp)
    {
        $this->filter['since'] = $timestamp->format('c');

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
