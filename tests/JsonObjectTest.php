<?php

namespace Harrysbaraini\JasonApi\Tests;

use Harrysbaraini\JasonApi\Attribute;
use Harrysbaraini\JasonApi\DataDocument;
use Harrysbaraini\JasonApi\Link;
use Harrysbaraini\JasonApi\LinksObject;
use Harrysbaraini\JasonApi\Resource;
use PHPUnit\Framework\TestCase;

class JsonObjectTest extends TestCase
{
    /** @test */
    public function data_object_is_valid()
    {
        $doc = new DataDocument(
            (new Resource('users', 1))
                ->attribute(new Attribute('name', 'Vanderlei Sbaraini Amancio'))
                ->attribute(new Attribute('email', 'hello@vanderleis.me'))
                ->attribute(new Attribute('gender', 'M'))
                ->links(
                    (new LinksObject())->link(new Link('self', '/users/1'))
                )
        );

        $expected = [
            'data' => [
                'type'       => 'users',
                'id'         => "1",
                'attributes' => [
                    'name'   => 'Vanderlei Sbaraini Amancio',
                    'email'  => 'hello@vanderleis.me',
                    'gender' => 'M',
                ],
                'links'      => [
                    'self' => '/users/1',
                ],
            ],
        ];

        $this->assertEquals(json_encode($expected), json_encode($doc));
    }
}
