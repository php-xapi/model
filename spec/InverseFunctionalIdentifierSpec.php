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
use Xabbuh\XApi\Model\Account;

class InverseFunctionalIdentifierSpec extends ObjectBehavior
{
    function it_can_be_built_with_an_mbox()
    {
        $this->beConstructedThrough(
            array('Xabbuh\XApi\Model\InverseFunctionalIdentifier', 'withMbox'),
            array('mailto:conformancetest@tincanapi.com')
        );

        $this->getMbox()->shouldReturn('mailto:conformancetest@tincanapi.com');
        $this->getMboxSha1Sum()->shouldReturn(null);
        $this->getOpenId()->shouldReturn(null);
        $this->getAccount()->shouldReturn(null);
    }

    function it_can_be_built_with_an_mbox_sha1_sum()
    {
        $this->beConstructedThrough(
            array('Xabbuh\XApi\Model\InverseFunctionalIdentifier', 'withMboxSha1Sum'),
            array('db77b9104b531ecbb0b967f6942549d0ba80fda1')
        );

        $this->getMbox()->shouldReturn(null);
        $this->getMboxSha1Sum()->shouldReturn('db77b9104b531ecbb0b967f6942549d0ba80fda1');
        $this->getOpenId()->shouldReturn(null);
        $this->getAccount()->shouldReturn(null);
    }

    function it_can_be_built_with_an_openid()
    {
        $this->beConstructedThrough(
            array('Xabbuh\XApi\Model\InverseFunctionalIdentifier', 'withOpenId'),
            array('http://openid.tincanapi.com')
        );

        $this->getMbox()->shouldReturn(null);
        $this->getMboxSha1Sum()->shouldReturn(null);
        $this->getOpenId()->shouldReturn('http://openid.tincanapi.com');
        $this->getAccount()->shouldReturn(null);
    }

    function it_can_be_built_with_an_account()
    {
        $account = new Account('test', 'https://tincanapi.com');
        $this->beConstructedThrough(
            array('Xabbuh\XApi\Model\InverseFunctionalIdentifier', 'withAccount'),
            array($account)
        );

        $this->getMbox()->shouldReturn(null);
        $this->getMboxSha1Sum()->shouldReturn(null);
        $this->getOpenId()->shouldReturn(null);
        $this->getAccount()->shouldReturn($account);
    }
}
