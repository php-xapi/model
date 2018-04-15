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
 * An activity provider's state stored on a remote LRS.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class State
{
    /**
     * @var Activity The associated activity
     */
    private $activity;

    /**
     * @var Actor The associated actor
     */
    private $actor;

    /**
     * @var string|null An optional registration id
     */
    private $registrationId;

    /**
     * @var string The state id
     */
    private $stateId;

    public function __construct(Activity $activity, Actor $actor, string $stateId, string $registrationId = null)
    {
        $this->activity = $activity;
        $this->actor = $actor;
        $this->stateId = $stateId;
        $this->registrationId = $registrationId;
    }

    /**
     * Returns the activity.
     *
     * @return Activity The activity
     */
    public function getActivity(): Activity
    {
        return $this->activity;
    }

    /**
     * Returns the actor.
     *
     * @return Actor The actor
     */
    public function getActor(): Actor
    {
        return $this->actor;
    }

    /**
     * Returns the registration id.
     *
     * @return string|null The registration id
     */
    public function getRegistrationId(): ?string
    {
        return $this->registrationId;
    }

    /**
     * Returns the state's id.
     *
     * @return string The id
     */
    public function getStateId(): string
    {
        return $this->stateId;
    }
}
