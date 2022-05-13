<?php

namespace GlimeshClient\Client;

use GlimeshClient\Adapters\Authentication\AuthenticationAdapter;
use GlimeshClient\Response\GlimeshApiResponse;
use GraphQL\Query;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
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
     * Make a request to the API using GraphQL, will return a simple, unmodified array
     */
    public function makeRequest(Query $query): GlimeshApiResponse
    {
        return new GlimeshApiResponse(
            $query,
            $this->makeRawStringRequest($query->__toString())
        );
    }

    /**
     * Not recommended
     */
    public function makeRawStringRequest(string $request): Response
    {
        $response = $this->guzzleClient->request(
            'GET',
            self::GLIMESH_URL . '/api/graph',
            [
                'body' => $request,
                'headers' => [
                    'Authorization' => $this->authAdapter->getAuthentication()
                ]
            ]
        );

        return $response;
    }
}
