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
 * xAPI context activities.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
final class ContextActivities
{
    private $parentActivity;
    private $groupingActivity;
    private $categoryActivity;
    private $otherActivity;

    public function __construct(Activity $parentActivity = null, Activity $groupingActivity = null, Activity $categoryActivity = null, Activity $otherActivity = null)
    {
        $this->parentActivity = $parentActivity;
        $this->groupingActivity = $groupingActivity;
        $this->categoryActivity = $categoryActivity;
        $this->otherActivity = $otherActivity;
    }

    public function withParentActivity(Activity $parentActivity)
    {
        $contextActivities = clone $this;
        $contextActivities->parentActivity = $parentActivity;

        return $contextActivities;
    }

    public function withGroupingActivity(Activity $groupingActivity)
    {
        $contextActivities = clone $this;
        $contextActivities->groupingActivity = $groupingActivity;

        return $contextActivities;
    }

    public function withCategoryActivity(Activity $categoryActivity)
    {
        $contextActivities = clone $this;
        $contextActivities->categoryActivity = $categoryActivity;

        return $contextActivities;
    }

    public function withOtherActivity(Activity $otherActivity)
    {
        $contextActivities = clone $this;
        $contextActivities->otherActivity = $otherActivity;

        return $contextActivities;
    }

    public function getParentActivity()
    {
        return $this->parentActivity;
    }

    public function getGroupingActivity()
    {
        return $this->groupingActivity;
    }

    public function getCategoryActivity()
    {
        return $this->categoryActivity;
    }

    public function getOtherActivity()
    {
        return $this->otherActivity;
    }
}
