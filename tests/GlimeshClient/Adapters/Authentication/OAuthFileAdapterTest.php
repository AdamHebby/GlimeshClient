<?php

namespace GlimeshClient\Tests\Adapters\Authentication;

use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class OAuthFileAdapterTest extends TestCase
{
    public function testNoAuthIsExpired()
    {
        $authFile = '/tmp/' . uniqid('authJson') . '.json';

        $auth = new OAuthFileAdapter(
            '123456789',
            '987654321',
            $authFile
        );

        $this->assertTrue($auth->isExpired());

        $this->assertNull($auth->getAuthentication());
    }
    public function testLoadedEmptyFileIsExpired()
    {
        $authFile = '/tmp/' . uniqid('authJson') . '.json';

        file_put_contents($authFile, json_encode([

        ]));

        $auth = new OAuthFileAdapter(
            '123456789',
            '987654321',
            $authFile
        );

        $this->assertTrue($auth->isExpired());

        unlink($authFile);
    }
    public function testLoadedValidFileIsNotExpired()
    {
        $authFile = '/tmp/' . uniqid('authJson') . '.json';

        file_put_contents($authFile, json_encode([
            'token_type' => 'TEST',
            'access_token' => 'FAKE_ACCESS_TOKEN',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'expires_in' => 816000,
        ]));

        $auth = new OAuthFileAdapter(
            '123456789',
            '987654321',
            $authFile
        );

        $this->assertEquals('TEST FAKE_ACCESS_TOKEN', $auth->getAuthentication());
        $this->assertFalse($auth->isExpired());
        unlink($authFile);
    }
    public function testExpiredBasedOnExpiresIn()
    {
        $authFile = '/tmp/' . uniqid('authJson') . '.json';

        file_put_contents($authFile, json_encode([
            'token_type' => 'TEST',
            'access_token' => 'FAKE_ACCESS_TOKEN',
            'created_at' => (new \DateTime())->sub(new \DateInterval('PT1H'))->format('Y-m-d H:i:s'),
            'expires_in' => 1,
        ]));

        $auth = new OAuthFileAdapter(
            '123456789',
            '987654321',
            $authFile
        );

        $this->assertTrue($auth->isExpired());
        $this->assertNull($auth->getAuthentication());
        unlink($authFile);
    }
    public function testAuthenticate()
    {
        $authFile = '/tmp/' . uniqid('authJson') . '.json';

        file_put_contents($authFile, json_encode([
            'token_type' => 'TEST',
            'access_token' => 'FAKE_ACCESS_TOKEN',
            'created_at' => (new \DateTime())->sub(new \DateInterval('PT1H'))->format('Y-m-d H:i:s'),
            'expires_in' => 1,
        ]));

        $auth = new OAuthFileAdapter(
            '123456789',
            '987654321',
            $authFile
        );

        $this->assertTrue($auth->isExpired());
        $this->assertNull($auth->getAuthentication());

        $mockHandler = new MockHandler();

        $mockHandler->append(new Response(200, [], json_encode([
            'token_type' => 'TEST',
            'access_token' => 'FAKE_ACCESS_TOKEN_TWO',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'expires_in' => 816000,
        ])));

        $httpClient = new Client([
            'handler' => $mockHandler,
        ]);

        $auth->authenticate($httpClient);

        $this->assertFalse($auth->isExpired());
        $this->assertEquals('TEST FAKE_ACCESS_TOKEN_TWO', $auth->getAuthentication());

        $this->assertEquals(
            'FAKE_ACCESS_TOKEN_TWO',
            json_decode(file_get_contents($authFile), true)['access_token']
        );

        unlink($authFile);
    }
    public function testAuthenticateFailsAndThrows()
    {
        $authFile = '/tmp/' . uniqid('authJson') . '.json';

        file_put_contents($authFile, json_encode([
            'token_type' => 'TEST',
            'access_token' => 'FAKE_ACCESS_TOKEN',
            'created_at' => (new \DateTime())->sub(new \DateInterval('PT1H'))->format('Y-m-d H:i:s'),
            'expires_in' => 1,
        ]));

        $auth = new OAuthFileAdapter(
            '123456789',
            '987654321',
            $authFile
        );

        $this->assertTrue($auth->isExpired());
        $this->assertNull($auth->getAuthentication());

        $mockHandler = new MockHandler();

        $mockHandler->append(new Response(400, [], json_encode([])));

        $httpClient = new Client([
            'handler' => $mockHandler,
        ]);
        unlink($authFile);

        $this->expectExceptionMessage('OAuth Request failed');
        $auth->authenticate($httpClient);
    }
}
