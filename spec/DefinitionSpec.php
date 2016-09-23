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
use Xabbuh\XApi\Model\Definition;
use Xabbuh\XApi\Model\LanguageMap;

class DefinitionSpec extends ObjectBehavior
{
    function its_properties_can_be_read()
    {
        $name = LanguageMap::create(array('en-US' => 'test'));
        $description = LanguageMap::create(array('en-US' => 'test'));
        $this->beConstructedWith(
            $name,
            $description,
            'http://id.tincanapi.com/activitytype/unit-test',
            'https://github.com/adlnet/xAPI_LRS_Test'
        );

        $this->getName()->shouldReturn($name);
        $this->getDescription()->shouldReturn($description);
        $this->getType()->shouldReturn('http://id.tincanapi.com/activitytype/unit-test');
        $this->getMoreInfo()->shouldReturn('https://github.com/adlnet/xAPI_LRS_Test');
    }

    function it_can_be_empty()
    {
        $this->getName()->shouldReturn(null);
        $this->getDescription()->shouldReturn(null);
        $this->getType()->shouldReturn(null);
        $this->getMoreInfo()->shouldReturn(null);

        $this->equals($this->createEmptyDefinition())->shouldReturn(true);
    }

    public function it_returns_a_new_instance_with_name()
    {
        $name = new LanguageMap();
        $definition = $this->withName($name);

        $this->getName()->shouldBeNull();

        $definition->shouldNotBe($this);
        $definition->shouldBeAnInstanceOf(get_class($this->getWrappedObject()));
        $definition->getName()->shouldReturn($name);
    }

    public function it_returns_a_new_instance_with_description()
    {
        $description = new LanguageMap();
        $definition = $this->withDescription($description);

        $this->getDescription()->shouldBeNull();

        $definition->shouldNotBe($this);
        $definition->shouldBeAnInstanceOf(get_class($this->getWrappedObject()));
        $definition->getDescription()->shouldReturn($description);
    }

    public function it_returns_a_new_instance_with_type()
    {
        $definition = $this->withType('http://id.tincanapi.com/activitytype/unit-test');

        $this->getType()->shouldBeNull();

        $definition->shouldNotBe($this);
        $definition->shouldBeAnInstanceOf(get_class($this->getWrappedObject()));
        $definition->getType()->shouldReturn('http://id.tincanapi.com/activitytype/unit-test');
    }

    public function it_returns_a_new_instance_with_more_info()
    {
        $definition = $this->withMoreInfo('https://github.com/adlnet/xAPI_LRS_Test');

        $this->getMoreInfo()->shouldBeNull();

        $definition->shouldNotBe($this);
        $definition->shouldBeAnInstanceOf(get_class($this->getWrappedObject()));
        $definition->getMoreInfo()->shouldReturn('https://github.com/adlnet/xAPI_LRS_Test');
    }

    function it_is_different_when_names_are_omitted_and_other_definition_contains_an_empty_list_of_names()
    {
        $this->equals(new Definition(new LanguageMap()))->shouldReturn(false);
    }

    function it_is_different_when_descriptions_are_omitted_and_other_definition_contains_an_empty_list_of_descriptions()
    {
        $this->equals(new Definition(null, new LanguageMap()))->shouldReturn(false);
    }

    protected function createEmptyDefinition()
    {
        return new Definition();
    }
}
