<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Activity;

class ContextActivitiesSpec extends ObjectBehavior
{
    public function its_properties_are_empty_by_default()
    {
        $this->getParentActivity()->shouldBeNull();
        $this->getGroupingActivity()->shouldBeNull();
        $this->getCategoryActivity()->shouldBeNull();
        $this->getOtherActivity()->shouldBeNull();
    }

    public function it_returns_a_new_instance_with_parent_activity()
    {
        $activity = new Activity('http://tincanapi.com/conformancetest/activityid');
        $contextActivities = $this->withParentActivity($activity);

        $this->getParentActivity()->shouldBeNull();

        $contextActivities->shouldNotBe($this);
        $contextActivities->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\ContextActivities');
        $contextActivities->getParentActivity()->shouldReturn($activity);
    }

    public function it_returns_a_new_instance_with_grouping_activity()
    {
        $activity = new Activity('http://tincanapi.com/conformancetest/activityid');
        $contextActivities = $this->withGroupingActivity($activity);

        $this->getGroupingActivity()->shouldBeNull();

        $contextActivities->shouldNotBe($this);
        $contextActivities->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\ContextActivities');
        $contextActivities->getGroupingActivity()->shouldReturn($activity);
    }

    public function it_returns_a_new_instance_with_category_activity()
    {
        $activity = new Activity('http://tincanapi.com/conformancetest/activityid');
        $contextActivities = $this->withCategoryActivity($activity);

        $this->getCategoryActivity()->shouldBeNull();

        $contextActivities->shouldNotBe($this);
        $contextActivities->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\ContextActivities');
        $contextActivities->getCategoryActivity()->shouldReturn($activity);
    }

    public function it_returns_a_new_instance_with_other_activity()
    {
        $activity = new Activity('http://tincanapi.com/conformancetest/activityid');
        $contextActivities = $this->withOtherActivity($activity);

        $this->getOtherActivity()->shouldBeNull();

        $contextActivities->shouldNotBe($this);
        $contextActivities->shouldBeAnInstanceOf('\Xabbuh\XApi\Model\ContextActivities');
        $contextActivities->getOtherActivity()->shouldReturn($activity);
    }
}
