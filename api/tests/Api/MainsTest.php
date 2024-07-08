<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class MainsTest extends ApiTestCase
{
    use ResetDatabase;

    public function testCreateGreeting(): void
    {
        // Test writableLink and readableLink using @id while "allow_extra_attributes: false".
        // Create a new main resource with some sub resources.
        static::createClient()->request('POST', '/mains', [
            'json' => [
                'name' => 'Main1',
                'subs' => [
                    [
                        'name' => 'SubArray1',
                    ],
                    [
                        'name' => 'SubArray2',
                    ],
                ],
                'sub1' => [
                    'name' => 'Sub1',
                ],
                'sub2' => [
                    'name' => 'Sub2',
                ],
            ],
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);
        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/Main',
            '@id' => '/mains/1',
            '@type' => 'Main',
            'id' => 1,
            'name' => 'Main1',
            'subs' =>
            [
                0 =>
                [
                    '@id' => '/subs/1',
                    '@type' => 'Sub',
                    'id' => 1,
                    'name' => 'SubArray1',
                ],
                1 =>
                [
                    '@id' => '/subs/2',
                    '@type' => 'Sub',
                    'id' => 2,
                    'name' => 'SubArray2',
                ],
            ],
            'sub1' =>
            [
                '@id' => '/subs/3',
                '@type' => 'Sub',
                'id' => 3,
                'name' => 'Sub1',
            ],
            'sub2' =>
            [
                '@id' => '/subs/4',
                '@type' => 'Sub',
                'id' => 4,
                'name' => 'Sub2',
            ],
        ]);

        // Update the main resource and update or remove or add some sub resources.
        static::createClient()->request('PUT', '/mains/1', [
            'json' => [
                '@id' => '/mains/1',
                'name' => 'Main1Edit',
                'subs' => [
                    [
                        '@id' => '/subs/1',
                        '@type' => 'Sub',
                        'name' => 'SubArray1Update',
                    ],
                    [
                        'name' => 'SubArray2Replaced',
                    ],
                ],
                'sub1' => [
                    '@id' => '/subs/3',
                    'name' => 'Sub1Update',
                ],
                'sub2' => [
                    'name' => 'Sub2Replaced',
                ],
            ],
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/contexts/Main',
            '@id' => '/mains/1',
            '@type' => 'Main',
            'id' => 1,
            'name' => 'Main1Edit',
            'subs' =>
            [
                0 =>
                [
                    '@id' => '/subs/1',
                    '@type' => 'Sub',
                    'id' => 1,
                    'name' => 'SubArray1Update',
                ],
                1 =>
                [
                    '@id' => '/subs/5',
                    '@type' => 'Sub',
                    'id' => 5,
                    'name' => 'SubArray2Replaced',
                ],
            ],
            'sub1' =>
            [
                '@id' => '/subs/3',
                '@type' => 'Sub',
                'id' => 3,
                'name' => 'Sub1Update',
            ],
            'sub2' =>
            [
                '@id' => '/subs/6',
                '@type' => 'Sub',
                'id' => 6,
                'name' => 'Sub2Replaced',
            ],
        ]);

        // Extra attributes are not allowed.
        static::createClient()->request('PUT', '/mains/1', [
            'json' => [
                '@id' => '/mains/1',
                'name' => 'Main1Edit',
                'subs' => [
                    [
                        '@id' => '/subs/1',
                        '@type' => 'Sub',
                        'name' => 'SubArray1Update',
                        'extra' => 'extra',
                    ],
                ],
            ],
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);
        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
              'detail' => 'Extra attributes are not allowed ("extra" is unknown).',
        ]);
    }
}
