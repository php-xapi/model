<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Model\Tests;

use Xabbuh\XApi\Model\Account;
use Xabbuh\XApi\Model\Actor;
use Xabbuh\XApi\Model\Agent;
use Xabbuh\XApi\Model\Group;
use Xabbuh\XApi\Model\InverseFunctionalIdentifier;

/**
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class ActorTest extends \PHPUnit_Framework_TestCase
{
    public function testActorsEqualWhenAllPropertiesAreEqual()
    {
        $agent1 = $this->createAgent();
        $agent2 = $this->createAgent();

        $this->assertTrue($agent1->equals($agent2));

        $group1 = $this->createGroup();
        $group2 = $this->createGroup();

        $this->assertTrue($group1->equals($group2));
    }

    public function testAgentAndGroupDoNotEqual()
    {
        $agent = $this->createAgent();
        $group = $this->createGroup();

        $this->assertFalse($agent->equals($group));
        $this->assertFalse($group->equals($agent));
    }

    /**
     * @dataProvider getActorsWithDifferingInverseFunctionalIdentifiers
     */
    public function testActorsDifferWhenInverseFunctionalIdentifierDiffer(Actor $actor1, Actor $actor2)
    {
        $this->assertFalse($actor1->equals($actor2));
    }

    public function getActorsWithDifferingInverseFunctionalIdentifiers()
    {
        return array(
            'agent-and-group' => array(
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
            ),
            'group-and-agent' => array(
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
            ),
            'agents-with-different-mboxes' => array(
                new Agent(InverseFunctionalIdentifier::withMbox('christian@example.com')),
                new Agent(InverseFunctionalIdentifier::withMbox('bob@example.com')),
            ),
            'groups-with-different-mboxes' => array(
                new Group(InverseFunctionalIdentifier::withMbox('christian@example.com')),
                new Group(InverseFunctionalIdentifier::withMbox('bob@example.com')),
            ),
            'agents-with-different-mbox-hashsums' => array(
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('bar')),
            ),
            'groups-with-different-mbox-hashsums' => array(
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('bar')),
            ),
            'agents-with-different-openids' => array(
                new Agent(InverseFunctionalIdentifier::withOpenId('aaron.openid.example.org')),
                new Agent(InverseFunctionalIdentifier::withOpenId('bob.openid.example.org')),
            ),
            'groups-with-different-openids' => array(
                new Group(InverseFunctionalIdentifier::withOpenId('aaron.openid.example.org')),
                new Group(InverseFunctionalIdentifier::withOpenId('bob.openid.example.org')),
            ),
            'agents-with-first-account-null' => array(
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
                new Agent(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
            ),
            'agents-with-other-account-null' => array(
                new Agent(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
            ),
            'groups-with-first-account-null' => array(
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
                new Group(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
            ),
            'groups-with-other-account-null' => array(
                new Group(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo')),
            ),
            'agents-with-different-account-names' => array(
                new Agent(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
                new Agent(InverseFunctionalIdentifier::withAccount(new Account('another user account', 'http://example.com/bob'))),
            ),
            'agents-with-different-account-home-pages' => array(
                new Agent(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
                new Agent(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/christian'))),
            ),
            'groups-with-different-account-names' => array(
                new Group(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
                new Group(InverseFunctionalIdentifier::withAccount(new Account('another user account', 'http://example.com/bob'))),
            ),
            'groups-with-different-account-home-pages' => array(
                new Group(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/bob'))),
                new Group(InverseFunctionalIdentifier::withAccount(new Account('user account', 'http://example.com/christian'))),
            ),
            'agents-with-different-names' => array(
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), 'Christian'),
                new Agent(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), 'Bob'),
            ),
            'groups-with-different-names' => array(
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), 'Christian'),
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), 'Bob'),
            ),
            'groups-with-different-number-of-members' => array(
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), array(
                    $this->createAgent1(),
                    $this->createAgent2(),
                    $this->createAgent3(),
                )),
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), array(
                    $this->createAgent1(),
                    $this->createAgent3(),
                )),
            ),
            'groups-with-different-members' => array(
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), array(
                    $this->createAgent1(),
                    $this->createAgent2(),
                )),
                new Group(InverseFunctionalIdentifier::withMboxSha1Sum('foo'), array(
                    $this->createAgent1(),
                    $this->createAgent3(),
                )),
            ),
        );
    }

    private function createAgent()
    {
        return new Agent(InverseFunctionalIdentifier::withMbox('mailto:christian@example.com'), 'Christian');
    }

    private function createAgent1()
    {
        return new Agent(InverseFunctionalIdentifier::withMbox('mailto:andrew@example.com'), 'Andrew Downes');
    }

    private function createAgent2()
    {
        return new Agent(InverseFunctionalIdentifier::withOpenId('aaron.openid.example.org'), 'Aaron Silvers');
    }

    private function createAgent3()
    {
        return new Agent(InverseFunctionalIdentifier::withMbox('mailto:christian@example.com'), 'Christian');
    }

    private function createGroup()
    {
        return new Group(InverseFunctionalIdentifier::withAccount(new Account('GroupAccount', 'http://example.com/homePage')), 'Example Group');
    }
}
