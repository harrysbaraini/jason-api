<?php

namespace Harrysbaraini\JasonApi\Tests;

use Harrysbaraini\JasonApi\Attribute;
use Harrysbaraini\JasonApi\Laravel\DataResponse;
use Harrysbaraini\JasonApi\Links\Link;
use Harrysbaraini\JasonApi\Links\LinksObject;
use Harrysbaraini\JasonApi\Relationships\Relationship;
use Harrysbaraini\JasonApi\Relationships\RelationshipsObject;
use Harrysbaraini\JasonApi\Resource;
use Harrysbaraini\JasonApi\ResourceCollection;
use Harrysbaraini\JasonApi\ResourceIdentifier;
use PHPUnit\Framework\TestCase;

class LaravelIntegrationTest extends TestCase
{
    /** @test */
    public function data_collection_is_valid()
    {
        $doc = new DataResponse(
            new ResourceCollection(
                (new Resource('users', 1))->attributes(new Attribute('name', 'Vanderlei')),
                (new Resource('users', 2))->attributes(new Attribute('name', 'Johnny'))
            )
        );

        $expected = [
            'data' => [
                [
                    'type'       => 'users',
                    'id'         => "1",
                    'attributes' => ['name' => 'Vanderlei'],
                ],
                [
                    'type'       => 'users',
                    'id'         => "2",
                    'attributes' => ['name' => 'Johnny'],
                ],
            ],
        ];

        $this->assertEquals(json_encode($expected), json_encode($doc->toArray()));
    }

    /** @test */
    public function data_object_is_valid()
    {
        $doc = new DataResponse(
            (new Resource('users', 1))
                ->attributes(
                    new Attribute('name', 'Vanderlei Sbaraini Amancio'),
                    new Attribute('email', 'hello@vanderleis.me'),
                    new Attribute('gender', 'M')
                )
                ->links(
                    (new LinksObject)->add(new Link('self', '/users/1'))
                )
                ->relationships(
                    (new RelationshipsObject)->add(
                        (new Relationship('address', new ResourceIdentifier('addresses', 9)))
                            ->links((new LinksObject())->add(
                                new Link('self', '/users/1/relationships/address'),
                                new Link('related', '/users/1/address')
                            ))
                    )
                )
        );

        $expected = [
            'data' => [
                'type'          => 'users',
                'id'            => "1",
                'attributes'    => [
                    'name'   => 'Vanderlei Sbaraini Amancio',
                    'email'  => 'hello@vanderleis.me',
                    'gender' => 'M',
                ],
                'links'         => [
                    'self' => '/users/1',
                ],
                'relationships' => [
                    'address' => [
                        'data'  => [
                            'type' => 'addresses',
                            'id'   => '9',
                        ],
                        'links' => [
                            'self'    => '/users/1/relationships/address',
                            'related' => '/users/1/address',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals(json_encode($expected), json_encode($doc->toArray()));
    }
}
