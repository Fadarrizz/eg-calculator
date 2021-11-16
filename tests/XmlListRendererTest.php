<?php

declare(strict_types=1);

namespace TestCase\Tests;

use TestCase\XmlListRenderer;

class XmlListRendererTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_renders_a_list_of_numbers_in_xml()
    {
        $xmlListRenderer = new XmlListRenderer;

        $result = $xmlListRenderer->render('renderTest', [2, 4, 6]);

        $this->assertXmlStringEqualsXmlFile(__DIR__.'/test.xml', $result);
    }

}
