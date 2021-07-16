<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\LanguageMap;

class LanguageMapSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('create', [[
            'de-DE' => 'teilgenommen',
            'en-GB' => 'attended',
        ]]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(LanguageMap::class);
    }

    public function it_can_be_created_with_an_existing_array_map()
    {
        $this->beConstructedThrough('create', [[
            'de-DE' => 'teilgenommen',
            'en-GB' => 'attended',
            'en-US' => 'attended',
        ]]);

        $this->offsetGet('de-DE')->shouldReturn('teilgenommen');
        $this->offsetGet('en-GB')->shouldReturn('attended');
        $this->offsetGet('en-US')->shouldReturn('attended');
    }

    public function it_returns_a_new_instance_with_an_added_entry()
    {
        $languageTag = $this->withEntry('en-US', 'attended');
        $languageTag->offsetExists('en-US')->shouldReturn(true);
        $languageTag->shouldNotBe($this);
        $this->offsetExists('en-US')->shouldReturn(false);
    }

    public function it_returns_a_new_instance_with_a_modified_entry()
    {
        $languageTag = $this->withEntry('en-GB', 'test');
        $languageTag->offsetGet('en-GB')->shouldReturn('test');
        $languageTag->shouldNotBe($this);
        $this->offsetGet('en-GB')->shouldReturn('attended');
    }

    public function its_language_tags_can_be_retrieved()
    {
        $languageTags = $this->languageTags();
        $languageTags->shouldBeArray();
        $languageTags->shouldHaveCount(2);
        $languageTags->shouldContain('de-DE');
        $languageTags->shouldContain('en-GB');
    }

    public function it_throws_an_exception_when_a_non_existent_language_tag_is_requested()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('offsetGet', ['en-US']);
    }

    public function it_can_be_asked_if_a_language_tag_is_known()
    {
        $this->offsetExists('en-GB')->shouldReturn(true);
        $this->offsetExists('en-US')->shouldReturn(false);
    }

    public function its_values_cannot_be_modified()
    {
        $this->shouldThrow('\LogicException')->during('offsetSet', ['en-US', 'attended']);
    }

    public function its_values_cannot_be_removed()
    {
        $this->shouldThrow('\LogicException')->during('offsetUnset', ['en-US']);
    }

    public function it_is_not_equal_with_another_language_map_if_number_of_entries_differ()
    {
        $languageMap = LanguageMap::create([
            'de-DE' => 'teilgenommen',
            'en-GB' => 'attended',
            'en-US' => 'attended',
        ]);

        $this->equals($languageMap)->shouldReturn(false);
    }

    public function it_is_not_equal_with_another_language_map_if_keys_differ()
    {
        $languageMap = LanguageMap::create([
            'de-DE' => 'teilgenommen',
            'en-US' => 'attended',
        ]);

        $this->equals($languageMap)->shouldReturn(false);
    }

    public function it_is_not_equal_with_another_language_map_if_values_differ()
    {
        $languageMap = LanguageMap::create([
            'de-DE' => 'teilgenommen',
            'en-GB' => 'participated',
        ]);

        $this->equals($languageMap)->shouldReturn(false);
    }

    public function it_is_equal_with_itself()
    {
        $this->equals($this)->shouldReturn(true);
    }

    public function it_is_equal_with_another_language_map_if_key_value_pairs_are_equal()
    {
        $languageMap = LanguageMap::create([
            'en-GB' => 'attended',
            'de-DE' => 'teilgenommen',
        ]);

        $this->equals($languageMap)->shouldReturn(true);
    }
}
