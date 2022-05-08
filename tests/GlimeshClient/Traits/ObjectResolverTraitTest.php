<?php

namespace GlimeshClient\Tests\Traits;

use GlimeshClient\Objects\User;
use GlimeshClient\Traits\ObjectResolverTrait;
use PHPUnit\Framework\TestCase;

/**
 * Tests the ObjectResolverTrait Logic
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient_Tests
 */
class ObjectResolverTraitTest extends TestCase
{
    use ObjectResolverTrait;

    public function testObjectInstantiation()
    {
        $data = [
            'avatar' => 'avatar',
            'avatarUrl' => 'avatarUrl',
            'confirmedAt' => '2021-01-01T01:01:01',
            'countFollowers' => '10',
            'countFollowing' => '10',
            'displayname' => 'displayname',
            'followers' => [
                [
                    'hasLiveNotifications' => false,
                    'id' => '4',
                    'insertedAt' => '2020-12-24T05:01:36',
                    'updatedAt' => '2020-12-24T05:01:36',
                    'user' => [
                        'avatar' => 'avatar',
                        'avatarUrl' => 'avatarUrl',
                        'confirmedAt' => '2021-01-01T01:01:01',
                        'countFollowers' => 12,
                        'countFollowing' => 12,
                        'displayname' => 'displayname',
                        'id' => '2'
                    ]
                ],
                [
                    'hasLiveNotifications' => false,
                    'id' => '4',
                    'insertedAt' => '2021-01-01T01:01:01',
                    'updatedAt' => '2021-01-01T01:01:01',
                    'user' => [
                        'avatar' => 'avatar',
                        'avatarUrl' => 'avatarUrl',
                        'confirmedAt' => '2021-01-01T01:01:01',
                        'countFollowers' => 12,
                        'countFollowing' => 12,
                        'displayname' => 'displayname',
                        'id' => '2'
                    ]
                ],
            ],
        ];


        $object = self::getObject('user', $data);

        $this->assertIsObject($object);
        $this->assertInstanceOf(User::class, $object);

        $this->assertInstanceOf(\ArrayObject::class, $object->followers);
    }

    public function testTraitThrows()
    {
        try {
            self::getObject('', []);
        } catch (\Throwable $th) {
            $this->assertTrue(stristr($th->getMessage(), 'Class not implemented for') >= 0);
        }
    }
}
