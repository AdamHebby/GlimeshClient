<?php

use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GlimeshClient\Client;
use GlimeshClient\Client\WebsocketClient;
use GlimeshClient\Objects\ChatMessage;
use GlimeshClient\Response\GlimeshWebsocketResponse;
use GraphQL\Query;
use GuzzleHttp\Client as GuzzleHttpClient;
use Ratchet\Client\WebSocket;
use React\EventLoop\Loop;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = (new Dotenv())->load(__DIR__ . '/../.env');


$logger = new \Monolog\Logger("log");
$logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());

$guzzle = new GuzzleHttpClient(['http_errors' => true, 'allow_redirects' => true]);

$query = (new Query('channel'))->setSelectionSet([
    'id',
    (new Query('stream'))->setSelectionSet([
        (new Query('category'))->setSelectionSet(['id']),
        'countChatters',
        'countViewers',
        'endedAt',
        'startedAt',
        'thumbnail',
        'title',
    ])
]);

$reactLoop = new Loop;

$socket = new WebsocketClient(
    $guzzle,
    new OAuthFileAdapter(
        $_ENV['CLIENT_ID'],
        $_ENV['CLIENT_SECRET'],
        '/tmp/auth.json'
    ),
    $logger,
    $reactLoop
);


$socket->makeRequest($query, function(WebSocket $connection, GlimeshWebsocketResponse $response) {
    $object = $response->getAsObject();

    var_dump($object);
});

$reactLoop->run();
