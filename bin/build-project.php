<?php

use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GlimeshClient\Client\BasicClient;
use GuzzleHttp\Client as GuzzleHttpClient;
use Symfony\Component\Dotenv\Dotenv;
use GlimeshClientBuilder\BuilderConfig;
use GlimeshClientBuilder\Builder;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = (new Dotenv())->load(__DIR__ . '/../.env');

$logger = new \Monolog\Logger("log");
$logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());

$client = new BasicClient(
    new GuzzleHttpClient([
        'http_errors' => true,
        'allow_redirects' => true
    ]),
    new OAuthFileAdapter(
        $_ENV['CLIENT_ID'],
        $_ENV['CLIENT_SECRET'],
        '/tmp/auth.json'
    ),
    $logger
);

$object = $client->makeRawStringRequest(
    file_get_contents(__DIR__ . '/../resources/introspection.txt')
);

file_put_contents(
    __DIR__ . '/../resources/api.json',
    json_encode(json_decode($object->getBody()->getContents()), JSON_PRETTY_PRINT)
);

$date = new \DateTime();

$config = (new BuilderConfig())
    ->setApiJsonFilePath(__DIR__ . '/../resources/api.json')
    ->setOutputDirectory(__DIR__ . '/../src/GlimeshClient')
    ->setNamespace('GlimeshClient')
    ->setStandardDocBlock([
        ' * @author Adam Hebden <adam@adamhebden.com>',
        ' * @copyright ' . $date->format('Y') . ' Adam Hebden',
        ' * @license GPL-3.0-or-later',
        ' * @package GlimeshClient',
        ' * @generated ' . $date->format('Y-m-d'),
    ]);

(new Builder($config))->build();
