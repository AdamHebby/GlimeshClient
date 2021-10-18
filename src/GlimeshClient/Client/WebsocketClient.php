<?php

namespace GlimeshClient\Client;

use Evenement\EventEmitterTrait;
use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Ratchet\Client\WebSocket;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;

/**
 * Glimesh Websocket Client
 *
 * WIP
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class WebsocketClient extends AbstractClient
{
    use EventEmitterTrait;

    /**
     * Current Authentication Adapter in use
     *
     * @var OAuthFileAdapter
     */
    protected $authAdapter = null;

    /**
     * LoopInterface to use
     *
     * @var LoopInterface
     */
    public $loop = null;

    /**
     * Array of current connections
     *
     * @var array<\Ratchet\Client\WebSocket>
     */
    protected $connections = [];

    /**
     * WebSocket URL
     *
     * @var string
     */
    protected static $wsUrl = 'wss://glimesh.tv/api/socket/websocket?vsn=2.0.0&token=';
    /**
     * Client Constructor
     *
     * @param \GuzzleHttp\Client $guzzleClient Guzzle Client to interact with the API
     * @param OAuthFileAdapter $authAdapter Auth to use
     * @param LoggerInterface|null $logger Defaults to NullLogger
     */
    public function __construct(
        \GuzzleHttp\Client $guzzleClient,
        OAuthFileAdapter $authAdapter,
        LoggerInterface $logger = null,
        \React\EventLoop\Loop $loop
    ) {
        $this->loop         = $loop;
        $this->authAdapter  = $authAdapter;
        $this->guzzleClient = $guzzleClient;
        $this->logger       = $logger ?? new NullLogger();

        $this->logger->info('Authenticating with Glimesh using ' . get_class($authAdapter));

        $this->authAdapter->authenticate($guzzleClient);

        $this->loop->addPeriodicTimer(15, function() {
            foreach ($this->connections as $connKey => $connection) {
                $this->logger->info("Sending heartbeat... {$connKey}");
                // $connection->send('["1","1","phoenix","heartbeat",{}]');
            }
        });
    }

    /**
     * Make a request to the API using GraphQL, will return a simple, unmodified array
     *
     * @param \GraphQL\Query $query
     */
    public function makeRequest(\GraphQL\Query $query, ?callable $onData = null)
    {
        $queryString = $query->__toString();
        $queryString = preg_replace('/^(query)/', 'subscription', $queryString);
        $queryString = str_replace("\n", " ", $queryString);

        return \Ratchet\Client\connect(self::$wsUrl . $this->authAdapter->getAccessToken(), [], [])->then(
            function(WebSocket $conn) use ($queryString, $onData) {
                $connKey = uniqid('conn_');
                $this->connections[$connKey] = $conn;

                $conn->on('message', function($msg) use ($conn, $onData) {
                    $data = json_decode($msg, true);

                    if ($data[3] === 'subscription:data') {
                        $data = $data[4]['result']['data'];

                        $keys = array_keys($data);
                        $key = reset($keys);

                        $obj = self::getObject($key, $data[$key]);

                        if ($onData !== null) {
                            $onData($conn, $obj);
                        }
                        $this->emit('subscription:data', [$conn, $obj]);
                    }
                });

                $conn->on('close', function () use ($connKey) {
                    $this->logger->info("Connection closed {$connKey}");
                    unset($this->connections[$connKey]);
                });

                // https://glimesh.github.io/api-docs/docs/chat/websockets/

                $conn->send('["1","1","__absinthe__:control","phx_join",{}]');
                $conn->send('["1","1","__absinthe__:control","doc",{"query":"' . $queryString . '","variables":{} } ]');

                $this->logger->info("Connection opened {$connKey}");
                $this->emit('connection', [$conn]);
            }, function (\Throwable $e) {
                echo "Could not connect: {$e->getMessage()}\n";
            }
        );
    }
}
