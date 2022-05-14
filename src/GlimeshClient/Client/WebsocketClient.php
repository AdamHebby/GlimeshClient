<?php

namespace GlimeshClient\Client;

use Evenement\EventEmitterTrait;
use GlimeshClient\Adapters\Authentication\OAuthFileAdapter;
use GlimeshClient\Response\GlimeshWebsocketResponse;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\Message;
use React\EventLoop\Loop;
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
     * Array of current connections
     *
     * @var array<\Ratchet\Client\WebSocket>
     */
    protected array $connections = [];

    /**
     * WebSocket URL
     */
    protected static string $wsUrl = 'wss://glimesh.tv/api/socket/websocket?vsn=2.0.0&token=';
    /**
     * Client Constructor
     *
     * @param Client $guzzleClient Guzzle Client to interact with the API
     * @param OAuthFileAdapter $authAdapter Auth to use
     * @param LoggerInterface|null $logger Defaults to NullLogger
     */
    public function __construct(
        Client $guzzleClient,
        OAuthFileAdapter $authAdapter,
        LoggerInterface $logger = null,
        /**
         * LoopInterface to use
         */
        public Loop $loop
    ) {
        $this->authAdapter  = $authAdapter;
        $this->guzzleClient = $guzzleClient;
        $this->logger       = $logger ?? new NullLogger();

        $this->logger->info('Authenticating with Glimesh using ' . $authAdapter::class);
        $this->authAdapter->authenticate($guzzleClient);

        $this->loop->addPeriodicTimer(20, function() {
            foreach ($this->connections as $connKey => $connection) {
                $this->logger->debug("Sending heartbeat... {$connKey}");
                $this->sendHeartbeat($connection);
            }
        });

        pcntl_signal(SIGINT, function(): never {
            $this->logger->debug('SIGINT received, closing connections');
            die; // Interrupts CTRL C
        });

        register_shutdown_function(function() {
            foreach ($this->connections as $connection) {
                $connection->close();
            }
            $this->loop->stop();
        });
    }

    /**
     * Get all connections
     *
     * @return WebSocket[]
     */
    public function getConnections(): array
    {
        return $this->connections;
    }

    /**
     * Make a request to the API using GraphQL, will return a simple, unmodified array
     */
    public function makeRequest(\GraphQL\Query $query, ?callable $onData = null): PromiseInterface
    {
        return \Ratchet\Client\connect(
            self::$wsUrl . $this->authAdapter->getAccessToken(),
            [],
            []
        )->then(
            function(WebSocket $conn) use ($query, $onData) {
                $connKey = uniqid('conn_');

                $conn->on('message', function(Message $msg) use ($conn, $onData, $query) {
                    $data = json_decode($msg, true);

                    if ($data[3] === 'subscription:data') {
                        $data = $data[4]['result'];

                        $response = new GlimeshWebsocketResponse($query, json_encode($data));

                        if ($onData) {
                            $onData($conn, $response);
                        }
                        $this->emit('subscription:data', [$conn, $response]);
                    }
                });


                $conn->on('close', function () use ($connKey) {
                    $this->logger->debug("Connection closed {$connKey}");
                    unset($this->connections[$connKey]);
                });

                // https://glimesh.github.io/api-docs/docs/chat/websockets/
                $this->sendJoinCommand($conn);
                $this->sendDocumentQuery($conn, $query);

                $this->logger->debug("Connection opened {$connKey}");
                $this->emit('connection', [$conn]);
                $this->connections[$connKey] = $conn;
            }
        );
    }

    /**
     * Sends a heartbeat to the websocket, needs to happen every 30s
     */
    protected function sendHeartbeat(WebSocket $connection): bool
    {
        return $connection->send(json_encode([
            1,
            1,
            'pheonix',
            'heartbeat',
            (object)[]
        ]));
    }

    /**
     * Send Absinthe Document Query
     */
    protected function sendDocumentQuery(WebSocket $connection, \GraphQL\Query $query): bool
    {
        $queryString = $query->__toString();
        $queryString = preg_replace('/^(query)/', 'subscription', $queryString);
        $queryString = str_replace("\n", " ", $queryString);

        return $connection->send(json_encode([
            1,
            1,
            '__absinthe__:control',
            'doc',
            (object)[
                'query' => $queryString,
                'variables' => (object)[],
            ]
        ]));
    }

    /**
     * Send Join Command
     */
    protected function sendJoinCommand(WebSocket $connection): bool
    {
        return $connection->send(json_encode([
            1,
            1,
            '__absinthe__:control',
            'phx_join',
            (object)[]
        ]));
    }
}
