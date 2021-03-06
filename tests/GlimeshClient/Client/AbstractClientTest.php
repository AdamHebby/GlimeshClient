<?php

namespace GlimeshClient\Tests\Client;

use GlimeshClient\Client\AbstractClient;
use GraphQL\Query;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

abstract class AbstractClientTest extends TestCase
{
    public function testPrettyPrintQuery()
    {
        $this->assertEquals(
            "query {\n    users\n}\n",
            AbstractClient::prettyPrintQuery(new Query('users'))
        );


        $this->assertEquals(
            "query {\n" .
            "    chatMessage {\n" .
            "        user {\n" .
            "            id\n" .
            "            username\n" .
            "            displayname\n" .
            "        }\n" .
            "        message\n" .
            "        channel {\n" .
            "            id\n" .
            "            title\n" .
            "        }\n" .
            "    }\n" .
            "}\n",
            AbstractClient::prettyPrintQuery(
                (new Query('chatMessage'))->setSelectionSet([
                    (new Query('user'))->setSelectionSet([
                        'id','username','displayname'
                    ]),
                    'message',
                    (new Query('channel'))->setSelectionSet([
                        'id', 'title'
                    ]),
                ])
            )
        );
    }

    /**
     * Make a Guzzle Response
     */
    public static function makeResponse(int $code, array $data, array $errors = []): Response
    {
        $response = [
            'errors' => $errors
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return new Response($code, [], json_encode($response));
    }

    /**
     * Make a guzzle client
     */
    public static function makeGuzzleClient(array $responses = []): \GuzzleHttp\Client
    {
        return new Client([
            'handler' => HandlerStack::create(
                new MockHandler($responses)
            )
        ]);
    }

    /**
     * Fake an error
     */
    public static function makeError(string $message): array
    {
        return [
            'locations' => [
                [
                    'column' => 1,
                    'line' => 1
                ]
            ],
            'message' => $message
        ];
    }
}
