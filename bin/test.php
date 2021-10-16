<?php

use GlimeshClient\Adapters\Authentication\ClientIDAuth;
use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GlimeshClient\Client;
use GlimeshClient\Objects\Enums\ChannelStatus;
use GraphQL\Query;
use GuzzleHttp\Client as GuzzleHttpClient;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = (new Dotenv())->load(__DIR__ . '/../.env');

$logger = new \Monolog\Logger("log");
$logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());

$guzzle = new GuzzleHttpClient(['http_errors' => true, 'allow_redirects' => true]);

// $client = new Client(
//     $guzzle,
//     new ClientIDAuth($_ENV['CLIENT_ID']),
//     $logger
// );

$client = new Client(
    $guzzle,
    new OAuthFileAdapter(
        $_ENV['CLIENT_ID'],
        $_ENV['CLIENT_SECRET'],
        '/tmp/auth.json'
    ),
    $logger
);


$object = ($client->makeRequest(
    (new Query('channels'))->setSelectionSet([
        'id',
        (new Query('stream'))->setSelectionSet([
            'thumbnail',
        ]),
    ])->setArguments(['status' => 'ENUM:' . ChannelStatus::LIVE])
));

foreach ($object as $o) {
    /**
     * @var Channel $o
     */
    var_dump($o->getAllNonObjectKeys());
}
