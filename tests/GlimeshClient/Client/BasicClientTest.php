<?php

namespace GlimeshClient\Tests\Client;

use GlimeshClient\Adapters\Authentication\ClientIDAuth;
use GlimeshClient\Client\BasicClient;
use GlimeshClient\Objects\User;
use GraphQL\Query;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Log\NullLogger;
use Psr\Log\Test\TestLogger;

class BasicClientTest extends AbstractClientTest
{
    /**
     * Test construction
     */
    public function testBasicClient()
    {
        $guzzleClient = self::makeGuzzleClient();
        $authAdapter  = new ClientIDAuth('CLIENT_ID');

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            new NullLogger
        );

        $this->assertInstanceOf(BasicClient::class, $client);
    }

    /**
     * Test a basic raw request
     */
    public function testBasicRawRequest()
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, ['hello' => 'world'], [])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            new NullLogger
        );

        $response = $client->makeRawRequest((new Query('users')));

        $this->assertEquals(['hello' => 'world'], $response);
    }

    /**
     * Test a basic raw request with an error
     */
    public function testRawRequestErrors()
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, ['hello' => 'world'], [self::makeError('ERROR')])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');
        $logger = new TestLogger();

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            $logger
        );

        $response = $client->makeRawRequest((new Query('users')));

        $this->assertEquals(['hello' => 'world'], $response);

        $this->assertTrue(
            $logger->hasErrorThatContains('Glimesh API Error, Col 1 Line 1: ERROR')
        );
    }

    /**
     * Test a basic raw request with an error that throws
     */

    public function testRawRequestErrorsThrow()
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, [], [self::makeError('ERROR')])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');
        $logger = new TestLogger();

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            $logger
        );

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Glimesh API Error, Col 1 Line 1: ERROR');

        $client->makeRawRequest((new Query('users')));
    }

    public function testMakeRequestReturnsObject()
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, [
                'user' => [
                    'avatar' => 'avatar',
                    'avatarUrl' => 'avatarUrl',
                    'confirmedAt' => '2021-01-01T01:01:01',
                    'countFollowers' => 12,
                    'countFollowing' => 12,
                    'displayname' => 'displayname',
                    'id' => '2'
                ]
            ], [])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            new NullLogger
        );

        $response = $client->makeRequest((new Query('users')));

        $this->assertInstanceOf(User::class, $response);
    }
}
