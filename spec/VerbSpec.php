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

class VerbSpec extends ObjectBehavior
{
    function it_detects_voiding_verbs()
    {
        $this->beConstructedWith('http://adlnet.gov/expapi/verbs/voided');
        $this->isVoidVerb()->shouldReturn(true);
    }

    function its_properties_can_be_read()
    {
        $this->beConstructedWith('http://tincanapi.com/conformancetest/verbid', array('en-US' => 'test'));

        $this->getId()->shouldReturn('http://tincanapi.com/conformancetest/verbid');
        $this->getDisplay()->shouldReturn(array('en-US' => 'test'));
    }

    function its_display_property_is_null_if_omitted()
    {
        $this->beConstructedWith('http://tincanapi.com/conformancetest/verbid');

        $this->getId()->shouldReturn('http://tincanapi.com/conformancetest/verbid');
        $this->getDisplay()->shouldReturn(null);
    }

    function it_creates_voiding_verb_through_factory_method()
    {
        $this->beConstructedThrough(array('Xabbuh\XApi\Model\Verb', 'createVoidVerb'));

        $this->shouldHaveType('Xabbuh\XApi\Model\Verb');
        $this->getId()->shouldReturn('http://adlnet.gov/expapi/verbs/voided');
    }
}
