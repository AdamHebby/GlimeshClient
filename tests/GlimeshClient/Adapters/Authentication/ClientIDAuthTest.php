<?php

namespace GlimeshClient\Tests\Adapters\Authentication;

use GlimeshClient\Adapters\Authentication\ClientIDAuth;
use PHPUnit\Framework\TestCase;

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
