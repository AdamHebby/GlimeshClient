<?php

use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GlimeshClient\Client\BasicClient;
use GlimeshClient\Objects\Enums\ChannelStatus;
use GraphQL\Query;
use GraphQL\RawObject;
use GuzzleHttp\Client as GuzzleHttpClient;
use Symfony\Component\Dotenv\Dotenv;

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

$response = $client->makeRequest(
    (new Query('channels'))->setSelectionSet([
        'count',
        (new Query('pageInfo '))->setSelectionSet([
            'endCursor',
            'hasNextPage',
            'hasPreviousPage',
            'startCursor',
        ]),
        (new Query('edges'))->setSelectionSet([
            (new Query('node'))->setSelectionSet([
                'id', 'status', 'title', 'language',
                (new Query('streamer'))->setSelectionSet([
                    'id', 'displayname', 'insertedAt'
                ]),
                (new Query('category'))->setSelectionSet([
                    'id', 'name', 'slug', 'insertedAt'
                ]),
                (new Query('bans'))->setSelectionSet([
                    'count',
                    (new Query('pageInfo'))->setSelectionSet([
                        'endCursor',
                        'hasNextPage',
                        'hasPreviousPage',
                        'startCursor',
                    ]),
                    (new Query('edges'))->setSelectionSet([
                        (new Query('node'))->setSelectionSet([
                            'id', 'reason'
                        ])
                    ])
                ])->setArguments(['first' => 2])
            ])
        ])
    ])->setArguments([
        'status' => new RawObject(ChannelStatus::LIVE->value),
        'first' => 5
    ])
);

file_put_contents(__DIR__ . '/../test.json', ($response->getAsJson()));

$channels = $response->getAsObject();

var_dump($channels);

$channels = $client->makeRequest(
    (new Query('channels'))->setSelectionSet([
        'count',
        (new Query('pageInfo '))->setSelectionSet([
            'endCursor',
            'hasNextPage',
            'hasPreviousPage',
            'startCursor',
        ]),
        (new Query('edges'))->setSelectionSet([
            (new Query('node'))->setSelectionSet([
                'id', 'status',
                (new Query('bans'))->setSelectionSet([
                    'count',
                    (new Query('pageInfo'))->setSelectionSet([
                        'endCursor',
                        'hasNextPage',
                        'hasPreviousPage',
                        'startCursor',
                    ]),
                    (new Query('edges'))->setSelectionSet([
                        (new Query('node'))->setSelectionSet([
                            'id', 'reason'
                        ])
                    ])
                ])->setArguments(['first' => 2])
            ])
        ])
    ])->setArguments([
        'status' => new RawObject(ChannelStatus::LIVE->value),
        'first' => 5,
        'after' => $channels->pageInfo->endCursor
    ])
);
