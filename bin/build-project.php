<?php

use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GlimeshClient\Client\BasicClient;
use GuzzleHttp\Client as GuzzleHttpClient;
use Symfony\Component\Dotenv\Dotenv;
use GlimeshClient\Builder\Builder;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = (new Dotenv())->load(__DIR__ . '/../.env');

$logger = new \Monolog\Logger("log");
$logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());

$guzzle = new GuzzleHttpClient(['http_errors' => true, 'allow_redirects' => true]);

$client = new BasicClient(
    $guzzle,
    new OAuthFileAdapter(
        $_ENV['CLIENT_ID'],
        $_ENV['CLIENT_SECRET'],
        '/tmp/auth.json'
    ),
    $logger
);

$object = $client->makeRawStringRequest(
    file_get_contents(__DIR__ . '/Builder/resources/introspection.txt')
);

file_put_contents(
    __DIR__ . '/Builder/resources/api.json',
    json_encode(json_decode($object->getBody()->getContents()), JSON_PRETTY_PRINT)
);

$builder = new Builder(__DIR__ . '/Builder/resources/api.json');

$builder->build();
