<?php

namespace Harrysbaraini\JasonApi\Tests;

use Harrysbaraini\JasonApi\Attribute;
use Harrysbaraini\JasonApi\DataDocument;
use Harrysbaraini\JasonApi\Resource;
use PHPUnit\Framework\TestCase;

class JsonObjectTest extends TestCase
{
    /** @test */
    public function data_object_is_valid()
    {
        $doc = new DataDocument(
            (new Resource('user', 1))
                ->attribute(new Attribute('name', 'Vanderlei Sbaraini Amancio'))
                ->attribute(new Attribute('email', 'hello@vanderleis.me'))
                ->attribute(new Attribute('gender', 'M'))
        );

        $expected = [
            'data' => [
                'type'       => 'user',
                'id'         => "1",
                'attributes' => [
                    'name'   => 'Vanderlei Sbaraini Amancio',
                    'email'  => 'hello@vanderleis.me',
                    'gender' => 'M',
                ],
            ],
        ];

        $this->assertEquals(json_encode($expected), json_encode($doc));
    }
}
