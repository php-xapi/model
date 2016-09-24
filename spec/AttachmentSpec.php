<?php

namespace spec\Xabbuh\XApi\Model;

use PhpSpec\ObjectBehavior;
use Xabbuh\XApi\Model\Attachment;
use Xabbuh\XApi\Model\LanguageMap;

class AttachmentSpec extends ObjectBehavior
{
    function its_properties_can_be_read()
    {
        $display = LanguageMap::create(array('en-US' => 'Text attachment'));
        $description = LanguageMap::create(array('en-US' => 'Text attachment description'));

        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            $display,
            $description,
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->getUsageType()->shouldReturn('http://id.tincanapi.com/attachment/supporting_media');
        $this->getContentType()->shouldReturn('text/plain');
        $this->getLength()->shouldReturn(18);
        $this->getSha2()->shouldReturn('bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545');
        $this->getDisplay()->shouldReturn($display);
        $this->getDescription()->shouldReturn($description);
        $this->getFileUrl()->shouldReturn('http://tincanapi.com/conformancetest/attachment/fileUrlOnly');
    }

    function it_is_not_equal_to_other_attachment_if_usage_types_differ()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://adlnet.gov/expapi/attachments/signature',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_content_types_differ()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'application/json',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_lengths_differ()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            65556,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_sha2_hashes_differ()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'd14f1580a2cebb6f8d4a8a2fc0d13c67f970e84f8d15677a93ae95c9080df899',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_displays_differ()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'JSON attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_only_this_attachment_has_a_description()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            null,
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_only_the_other_attachment_has_a_description()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            null,
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_descriptions_are_not_equal()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-GB' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_only_this_attachment_has_a_file_url()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description'))
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_only_the_other_attachment_has_a_file_url()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description'))
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_not_equal_to_other_attachment_if_file_urls_are_not_equal()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/signature'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/certificate'
        );

        $this->equals($attachment)->shouldReturn(false);
    }

    function it_is_equal_to_other_attachment_if_all_properties_are_equal()
    {
        $this->beConstructedWith(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $attachment = new Attachment(
            'http://id.tincanapi.com/attachment/supporting_media',
            'text/plain',
            18,
            'bd1a58265d96a3d1981710dab8b1e1ed04a8d7557ea53ab0cf7b44c04fd01545',
            LanguageMap::create(array('en-US' => 'Text attachment')),
            LanguageMap::create(array('en-US' => 'Text attachment description')),
            'http://tincanapi.com/conformancetest/attachment/fileUrlOnly'
        );

        $this->equals($attachment)->shouldReturn(true);
    }
}
