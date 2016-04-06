<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Activity;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\DocumentData;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;
use Xabbuh\XApi\Model\State;

class StateDocumentSpec extends ObjectBehavior
{
    function let()
    {
        $activity = new Activity('http://tincanapi.com/conformancetest/activityid');
        $actor = new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'));
        $this->beConstructedWith(new State($activity, $actor, 'state-id'), new DocumentData(array(
            'x' => 'foo',
            'y' => 'bar',
        )));
    }

    function it_is_a_document()
    {
        $this->shouldHaveType('Xabbuh\XApi\Model\Document');
    }

    function its_data_can_be_read()
    {
        $this->offsetExists('x')->shouldReturn(true);
        $this->offsetGet('x')->shouldReturn('foo');
        $this->offsetExists('y')->shouldReturn(true);
        $this->offsetGet('y')->shouldReturn('bar');
        $this->offsetExists('z')->shouldReturn(false);
    }

    function it_throws_exception_when_not_existing_data_is_being_read()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringOffsetGet('z');
    }

    function its_data_cannot_be_manipulated()
    {
        $this->shouldThrow('\Xabbuh\XApi\Common\Exception\UnsupportedOperationException')->duringOffsetSet('z', 'baz');
        $this->shouldThrow('\Xabbuh\XApi\Common\Exception\UnsupportedOperationException')->duringOffsetUnset('x');
    }
}
