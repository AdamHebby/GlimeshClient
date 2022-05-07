<?php

use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GlimeshClient\Client;
use GlimeshClient\Client\WebsocketClient;
use GlimeshClient\Objects\ChatMessage;
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

$query = (new Query('chatMessage'))->setSelectionSet([
    (new Query('user'))->setSelectionSet(['id','username','displayname']),
    'message',
    (new Query('channel'))->setSelectionSet([
        'id', 'title'
    ]),
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


$socket->makeRequest($query, function(WebSocket $connection, ChatMessage $object) {
    var_dump($object->message);
});

$reactLoop->run();
