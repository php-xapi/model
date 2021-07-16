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
use Xabbuh\XApi\Model\StatementId;
use Xabbuh\XApi\Model\Uuid;

class StatementIdSpec extends ObjectBehavior
{
    public function it_can_be_created_from_a_uuid()
    {
        $this->beConstructedThrough('fromUuid', [Uuid::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af')]);
        $this->shouldBeAnInstanceOf(StatementId::class);
    }

    public function it_can_be_created_from_a_string()
    {
        $this->beConstructedThrough('fromString', ['39e24cc4-69af-4b01-a824-1fdc6ea8a3af']);
        $this->shouldBeAnInstanceOf(StatementId::class);
    }

    public function it_should_reject_malformed_uuids()
    {
        $this->beConstructedThrough('fromString', ['bad-uuid']);
        $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }

    public function its_value_is_a_uuid_string()
    {
        $this->beConstructedThrough('fromUuid', [Uuid::fromString('39e24cc4-69af-4b01-a824-1fdc6ea8a3af')]);

        $this->getValue()->shouldReturn('39e24cc4-69af-4b01-a824-1fdc6ea8a3af');
    }

    public function it_is_equal_to_statement_ids_with_equal_value()
    {
        $value = '39e24cc4-69af-4b01-a824-1fdc6ea8a3af';
        $uuid = Uuid::fromString($value);

        $this->beConstructedThrough('fromUuid', [$uuid]);

        $this->equals(StatementId::fromString($value))->shouldReturn(true);
        $this->equals(StatementId::fromUuid(Uuid::fromString($value)))->shouldReturn(true);
        $this->equals(StatementId::fromUuid($uuid))->shouldReturn(true);
    }
}
