<?php

namespace GlimeshClient\Tests\Client;

use GlimeshClient\Adapters\Authentication\ClientIDAuth;
use GlimeshClient\Client\BasicClient;
use GlimeshClient\Objects\Channel;
use GlimeshClient\Objects\User;
use GlimeshClient\Objects\PagedArrayObject;
use GlimeshClient\Response\GlimeshApiResponse;
use GraphQL\Query;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Log\NullLogger;

class BasicClientTest extends AbstractClientTest
{
    /**
     * Test construction
     */
    public function testBasicClient(): void
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
    public function testBasicRawRequest(): void
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, ['hello' => 'world'], [])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            new NullLogger()
        );

        $response = $client->makeRequest((new Query('users')));

        $this->assertInstanceof(GlimeshApiResponse::class, $response);
        $this->assertInstanceof(Response::class, $response->getGuzzleResponse());

        $this->assertEquals(['data' => ['hello' => 'world']], $response->getAsArray());
    }

    /**
     * Test a basic raw request with an error
     */
    public function testRawRequestErrors(): void
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, ['hello' => 'world'], [self::makeError('ERROR')])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');
        $logger = new NullLogger();
        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            $logger
        );

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Glimesh API Error, Col 1 Line 1: ERROR');

        $response = $client->makeRequest((new Query('users')));
    }

    /**
     * Test a basic raw request with an error that throws
     */
    public function testRawRequestErrorsThrow(): void
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, [], [self::makeError('ERROR')])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');
        $logger = new NullLogger();

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            $logger
        );

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Glimesh API Error, Col 1 Line 1: ERROR');

        $client->makeRequest((new Query('users')));
    }

    public function testRequestReturnsNoDataOrErrorThrows(): void
    {
        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, [], [])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');
        $logger = new NullLogger();

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            $logger
        );

        $this->expectException(\Exception::class);

        $client->makeRequest((new Query('users')));
    }

    public function testMakeRequestReturnsObject(): void
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

        $response = $client->makeRequest((new Query('users')))->getAsObject();

        $this->assertInstanceOf(User::class, $response);
    }

    public function testResponseLoadsFromJsonFile(): void
    {
        $file = __DIR__ . '/../../resources/example_response.json';

        $guzzleClient = self::makeGuzzleClient([
            self::makeResponse(200, json_decode(file_get_contents($file), true)['data'], [])
        ]);

        $authAdapter = new ClientIDAuth('CLIENT_ID');

        $client = new BasicClient(
            $guzzleClient,
            $authAdapter,
            new NullLogger
        );

        $response = $client->makeRequest((new Query('channels')))->getAsObject();

        $this->assertInstanceOf(PagedArrayObject::class, $response);
        $this->assertInstanceOf(Channel::class, $response->getIterator()->current());
    }
}
