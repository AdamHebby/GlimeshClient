<?php

namespace GlimeshClient\Tests\Traits;

use GlimeshClient\Objects\User;
use GlimeshClient\Objects\UserSocial;
use GlimeshClient\Traits\ObjectModelTrait;
use PHPUnit\Framework\TestCase;

/**
 * Tests the ObjectModelTrait Logic
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient_Tests
 */
class ObjectModelTraitTest extends TestCase
{
    public function testBasicInstantion()
    {
        $user = new UserSocial([
            'id' => '123',
            'insertedAt' => new \DateTime(),
        ]);

        $this->assertEquals('123', $user->id);
        $this->assertInstanceOf(\DateTime::class, $user->insertedAt);
        $this->assertNull($user->identifier);
    }
}
