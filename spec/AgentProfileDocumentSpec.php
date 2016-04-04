<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\AgentProfile;
use Xabbuh\XApi\Model\DocumentData;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;

class AgentProfileDocumentSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new AgentProfile('id', new Agent(InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com'))), new DocumentData(array(
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

    function its_data_cannot_be_manipulated()
    {
        $this->shouldThrow('\Xabbuh\XApi\Common\Exception\UnsupportedOperationException')->duringOffsetSet('z', 'baz');
        $this->shouldThrow('\Xabbuh\XApi\Common\Exception\UnsupportedOperationException')->duringOffsetUnset('x');
    }
}
