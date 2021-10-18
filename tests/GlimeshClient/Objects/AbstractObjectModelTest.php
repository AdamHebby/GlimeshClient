<?php

namespace GlimeshClient\Tests\Objects;

use GlimeshClient\Objects\Category;
use GlimeshClient\Objects\Stream;
use PHPUnit\Framework\TestCase;

/**
 * Tests the AbstractObjectModel using Objects
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient_Tests
 */
class AbstractObjectModelTest extends TestCase
{
    public function testConstruct()
    {
        $stream = new Stream([
            'avgChatters' => 12,
            'avgViewers' => 13,
            'category' => [
                'id' => 2,
                'name' => 'CategoryTest',
                'slug' => 'CategoryTest',
                'subcategories' => [
                    [
                        'id' => 1,
                        'name' => 'Test',
                    ]
                ]
            ],
            'channel' => 'SomeChannel',
            'countChatters' => 14,
            'countViewers' => 15,
        ]);

        $this->assertEquals(12, $stream->avgChatters);
        $this->assertEquals(13, $stream->avgViewers);
        $this->assertEquals('CategoryTest', $stream->category->slug);
        $this->assertInstanceOf(Category::class, $stream->category);
    }

    public function testToArray()
    {
        $array = [
            'avgChatters' => 12,
            'avgViewers' => 13,
            'channel' => ['id' => 1, 'name' => 'channel', 'title' => 'test!'],
            'countChatters' => 14,
            'countViewers' => 15,
            'insertedAt' => new \DateTime('now')
        ];

        $expected = $array;
        $expected['insertedAt'] = $expected['insertedAt']->format('Y-m-d\TH:i:s');
        $expected['channel'] = ['id' => 1, 'title' => 'test!'];

        $stream = new Stream($array);


        $this->assertEquals($expected, $stream->toArray(true));
        $this->assertNotEquals($expected, $stream->toArray(false));

        $this->assertArrayHasKey('category', $stream->toArray(false));
        $this->assertTrue(count($stream->toArray(false)['channel']) > 1);
    }

    public function testGetAllKeys()
    {
        $array = Stream::getAllKeys();

        $this->assertNotEmpty($array);
        $this->assertTrue(count($array) > 5);
        $this->assertTrue(in_array('category', $array));
    }

    public function testGetAllKeysExcluding()
    {
        $array = Stream::getAllKeys(['category']);

        $this->assertNotEmpty($array);
        $this->assertTrue(count($array) > 5);
        $this->assertFalse(in_array('category', $array));
    }

    public function testGetAllNonObjectKeys()
    {
        $array = Stream::getAllNonObjectKeys();

        $this->assertNotEmpty($array);
        $this->assertTrue(count($array) > 5);
        $this->assertFalse(in_array('category', $array));
        $this->assertTrue(in_array('countChatters', $array));
    }

    public function testGetAllNonObjectKeysExcluding()
    {
        $array = Stream::getAllNonObjectKeys(['countChatters']);

        $this->assertNotEmpty($array);
        $this->assertTrue(count($array) > 5);
        $this->assertFalse(in_array('category', $array));
        $this->assertFalse(in_array('countChatters', $array));
        $this->assertTrue(in_array('countViewers', $array));
    }
}
