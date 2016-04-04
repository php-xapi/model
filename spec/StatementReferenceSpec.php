<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;

class StatementReferenceSpec extends ObjectBehavior
{
    function it_is_an_xapi_object()
    {
        $this->beConstructedWith('16fd2706-8baf-433b-82eb-8c7fada847da');
        $this->shouldHaveType('Xabbuh\XApi\Model\Object');
    }
}
