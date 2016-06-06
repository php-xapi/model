<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Activity;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;
use Xabbuh\XApi\Model\Verb;

class StatementsFilterSpec extends ObjectBehavior
{
    function it_does_not_filter_anything_by_default()
    {
        $filter = $this->getFilter();
        $filter->shouldHaveCount(0);
    }

    function it_can_filter_by_actor()
    {
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $this->byActor($actor)->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('agent', $actor);
    }

    function it_can_filter_by_verb()
    {
        $this->byVerb(new Verb('http://tincanapi.com/conformancetest/verbid', array('en-US' => 'test')))->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('verb', 'http://tincanapi.com/conformancetest/verbid');
    }

    function it_can_filter_by_activity()
    {
        $this->byActivity(new Activity('http://tincanapi.com/conformancetest/activityid'))->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('activity', 'http://tincanapi.com/conformancetest/activityid');
    }

    function it_can_filter_by_registration()
    {
        $this->byRegistration('foo')->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('registration', 'foo');
    }

    function it_can_enable_to_filter_related_activities()
    {
        $this->enableRelatedActivityFilter()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('related_activities', 'true');
    }

    function it_can_disable_to_filter_related_activities()
    {
        $this->disableRelatedActivityFilter()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('related_activities', 'false');
    }

    function it_can_enable_to_filter_related_agents()
    {
        $this->enableRelatedAgentFilter()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('related_agents', 'true');
    }

    function it_can_disable_to_filter_related_agents()
    {
        $this->disableRelatedAgentFilter()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('related_agents', 'false');
    }

    function it_can_include_attachments()
    {
        $this->includeAttachments()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('attachments', 'true');
    }

    function it_can_exclude_attachments()
    {
        $this->excludeAttachments()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('attachments', 'false');
    }

    function it_can_filter_by_timestamp()
    {
        $this->since(\DateTime::createFromFormat(\DateTime::ISO8601, '2013-05-18T05:32:34Z'))->shouldReturn($this);
        $this->getFilter()->shouldHaveKeyWithValue('since', '2013-05-18T05:32:34+00:00');

        $this->until(\DateTime::createFromFormat(\DateTime::ISO8601, '2014-05-18T05:32:34Z'))->shouldReturn($this);
        $this->getFilter()->shouldHaveKeyWithValue('until', '2014-05-18T05:32:34+00:00');
    }

    function it_can_sort_the_result_in_ascending_order()
    {
        $this->ascending()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('ascending', 'true');
    }

    function it_can_sort_the_result_in_descending_order()
    {
        $this->descending()->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('ascending', 'false');
    }

    function it_can_limit_the_number_of_results()
    {
        $this->limit(10)->shouldReturn($this);

        $filter = $this->getFilter();
        $filter->shouldHaveCount(1);
        $filter->shouldHaveKeyWithValue('limit', 10);
    }

    function it_rejects_choosing_a_negative_number_of_results()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringLimit(-1);
    }

    function it_can_change_the_result_format()
    {
        $this->format('ids')->shouldReturn($this);
        $this->getFilter()->shouldHaveKeyWithValue('format', 'ids');

        $this->format('exact')->shouldReturn($this);
        $this->getFilter()->shouldHaveKeyWithValue('format', 'exact');

        $this->format('canonical')->shouldReturn($this);
        $this->getFilter()->shouldHaveKeyWithValue('format', 'canonical');
    }

    function it_rejects_invalid_format_filter()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringFormat('minimal');
    }
}
