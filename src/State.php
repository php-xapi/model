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
    private $activity;
    private $actor;
    private $registrationId;
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
     */
    public function getActivity(): Activity
    {
        return $this->activity;
    }

    /**
     * Returns the actor.
     */
    public function getActor(): Actor
    {
        return $this->actor;
    }

    /**
     * Returns the registration id.
     */
    public function getRegistrationId(): ?string
    {
        return $this->registrationId;
    }

    /**
     * Returns the state's id.
     */
    public function getStateId(): string
    {
        return $this->stateId;
    }
}
