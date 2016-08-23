<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;

class ExtensionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array('http://id.tincanapi.com/extension/topic' => 'Conformance Testing'));
    }

    function its_extensions_can_be_read()
    {
        $this->beConstructedWith(array(
            'http://id.tincanapi.com/extension/topic' => 'Conformance Testing',
            'http://id.tincanapi.com/extension/color' => array(
                'model' => 'RGB',
                'value' => '#FFFFFF',
            ),
            'http://id.tincanapi.com/extension/starting-position' => 1,
        ));

        $this->offsetExists('http://id.tincanapi.com/extension/topic')->shouldReturn(true);
        $this->offsetGet('http://id.tincanapi.com/extension/topic')->shouldReturn('Conformance Testing');

        $this->offsetExists('http://id.tincanapi.com/extension/color')->shouldReturn(true);
        $this->offsetGet('http://id.tincanapi.com/extension/color')->shouldReturn(array(
            'model' => 'RGB',
            'value' => '#FFFFFF',
        ));

        $this->offsetExists('http://id.tincanapi.com/extension/starting-position')->shouldReturn(true);
        $this->offsetGet('http://id.tincanapi.com/extension/starting-position')->shouldReturn(1);
    }

    function it_throws_exception_when_not_existing_extension_is_being_read()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringOffsetGet('z');
    }

    function its_extensions_cannot_be_manipulated()
    {
        $this->shouldThrow('\Xabbuh\XApi\Common\Exception\UnsupportedOperationException')->duringOffsetSet('z', 'baz');
        $this->shouldThrow('\Xabbuh\XApi\Common\Exception\UnsupportedOperationException')->duringOffsetUnset('x');
    }
}
