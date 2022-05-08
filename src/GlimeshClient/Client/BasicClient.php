<?php

namespace GlimeshClient\Client;

use GlimeshClient\Adapters\Authentication\AuthenticationAdapter;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Glimesh Basic Client
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class BasicClient extends AbstractClient
{
    /**
     * Client Constructor
     *
     * @param \GuzzleHttp\Client $guzzleClient Guzzle Client to interact with the API
     * @param AuthenticationAdapter $authAdapter Auth to use
     * @param LoggerInterface|null $logger Defaults to NullLogger
     */
    public function __construct(
        Client $guzzleClient,
        AuthenticationAdapter $authAdapter,
        LoggerInterface $logger = null
    ) {
        $this->authAdapter  = $authAdapter;
        $this->guzzleClient = $guzzleClient;
        $this->logger       = $logger ?? new NullLogger();

        $this->logger->info('Authenticating with Glimesh using ' . $authAdapter::class);

        $this->authAdapter->authenticate($guzzleClient);
    }

    /**
     * Make a request to the API using GraphQL, will return a complex object structure
     * based on the return value
     */
    public function makeRequest(\GraphQL\Query $query): object
    {
        $data = $this->makeRawRequest($query);
        $arrayKeys = array_keys($data);

        $key = reset($arrayKeys);

        $this->logger->debug('Request made, building object');

        return self::getObject($key, $data[$key]);
    }

    /**
     * Make a request to the API using GraphQL, will return a simple, unmodified array
     */
    public function makeRawRequest(\GraphQL\Query $query): array
    {
        $req = $this->guzzleClient->request(
            'GET',
            self::GLIMESH_URL . '/api',
            [
                'body' => $query->__toString(),
                'headers' => [
                    'Authorization' => $this->authAdapter->getAuthentication()
                ]
            ]
        );

        $data = json_decode($req->getBody()->getContents(), true);

        if (!isset($data['data'])) {
            throw new \Exception(self::getAllErrorStrings($data['errors']));
        }

        array_map(function(array $error) {
            $this->logger->error(self::getErrorString($error));
        }, $data['errors'] ?? []);

        return $data['data'];
    }
}