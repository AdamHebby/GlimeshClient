<?php

namespace GlimeshClient\Tests\Adapters\Authentication;

use GlimeshClient\Adapters\Authentication\ClientIDAuth;
use PHPUnit\Framework\TestCase;

/**
 * Tests the ClientIDAuth Adapter
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient_Tests
 */
class ClientIDAuthTest extends TestCase
{
    public function testBasic()
    {
        $auth = new ClientIDAuth('981723918273');

        $this->assertEquals('Client-ID 981723918273', $auth->getAuthentication());

        $auth->authenticate(new \GuzzleHttp\Client());

        $auth = new ClientIDAuth('123');

        $this->assertEquals('Client-ID 123', $auth->getAuthentication());

        $this->assertFalse($auth->isExpired());
    }
}
