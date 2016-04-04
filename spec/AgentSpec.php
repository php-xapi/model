<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;

class AgentSpec extends ObjectBehavior
{
    function it_is_an_actor()
    {
        $iri = InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com');
        $this->beConstructedWith($iri);
        $this->shouldHaveType('Xabbuh\XApi\Model\Actor');
    }

    function its_properties_can_be_read()
    {
        $iri = InverseFunctionalIdentifier::withMbox('mailto:conformancetest@tincanapi.com');
        $this->beConstructedWith($iri, 'test');

        $this->getInverseFunctionalIdentifier()->shouldReturn($iri);
        $this->getName()->shouldReturn('test');
    }
}
