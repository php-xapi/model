<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Extensions;

class ExtensionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array('http://id.tincanapi.com/extension/topic' => 'Conformance Testing'));
    }

    function its_extensions_can_be_read()
    {
        $extensions = array(
            'http://id.tincanapi.com/extension/topic' => 'Conformance Testing',
            'http://id.tincanapi.com/extension/color' => array(
                'model' => 'RGB',
                'value' => '#FFFFFF',
            ),
            'http://id.tincanapi.com/extension/starting-position' => 1,
        );
        $this->beConstructedWith($extensions);

        $this->offsetExists('http://id.tincanapi.com/extension/topic')->shouldReturn(true);
        $this->offsetGet('http://id.tincanapi.com/extension/topic')->shouldReturn('Conformance Testing');

        $this->offsetExists('http://id.tincanapi.com/extension/color')->shouldReturn(true);
        $this->offsetGet('http://id.tincanapi.com/extension/color')->shouldReturn(array(
            'model' => 'RGB',
            'value' => '#FFFFFF',
        ));

        $this->offsetExists('http://id.tincanapi.com/extension/starting-position')->shouldReturn(true);
        $this->offsetGet('http://id.tincanapi.com/extension/starting-position')->shouldReturn(1);

        $this->getExtensions()->shouldReturn($extensions);
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

    function its_not_equal_to_other_extensions_with_a_different_number_of_entries()
    {
        $this->beConstructedWith(array('http://id.tincanapi.com/extension/topic' => 'Conformance Testing'));

        $this->equals(new Extensions(array()))->shouldReturn(false);
        $this->equals(new Extensions(array(
            'http://id.tincanapi.com/extension/topic' => 'Conformance Testing',
            'http://id.tincanapi.com/extension/starting-position' => 1,
        )))->shouldReturn(false);
    }

    function its_not_equal_to_other_extensions_if_extension_names_differ()
    {
        $this->beConstructedWith(array('http://id.tincanapi.com/extension/topic' => 'Conformance Testing'));

        $this->equals(new Extensions(array('http://id.tincanapi.com/extension/subject' => 'Conformance Testing')))->shouldReturn(false);
    }

    function its_not_equal_to_other_extensions_if_extension_values_differ()
    {
        $this->beConstructedWith(array('http://id.tincanapi.com/extension/topic' => 'Conformance Testing'));

        $this->equals(new Extensions(array('http://id.tincanapi.com/extension/topic' => 'Conformance Tests')))->shouldReturn(false);
    }

    function its_equal_to_other_extensions_even_if_extension_names_are_in_different_order()
    {
        $this->beConstructedWith(array(
            'http://id.tincanapi.com/extension/topic' => 'Conformance Testing',
            'http://id.tincanapi.com/extension/color' => array(
                'model' => 'RGB',
                'value' => '#FFFFFF',
            ),
            'http://id.tincanapi.com/extension/starting-position' => 1,
        ));

        $this->equals(new Extensions(array(
            'http://id.tincanapi.com/extension/starting-position' => 1,
            'http://id.tincanapi.com/extension/color' => array(
                'model' => 'RGB',
                'value' => '#FFFFFF',
            ),
            'http://id.tincanapi.com/extension/topic' => 'Conformance Testing',
        )))->shouldReturn(true);
    }
}
