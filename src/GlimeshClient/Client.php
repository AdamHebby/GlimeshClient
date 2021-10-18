<?php

namespace GlimeshClient;

use GlimeshClient\Adapters\Authentication\AuthenticationAdapter;
use GlimeshClient\Traits\ObjectResolverTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Glimesh Client
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Client
{
    use ObjectResolverTrait;

    /**
     * Glimesh URL
     */
    public const GlimUrl = 'https://glimesh.tv';

    /**
     * Current Authentication Adapter in use
     *
     * @var AuthenticationAdapter
     */
    private $authAdapter = null;

    /**
     * Current GuzzleClient used to interact with the API
     *
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient = null;

    /**
     * Current Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $logger = null;

    /**
     * Client Constructor
     *
     * @param \GuzzleHttp\Client $guzzleClient Guzzle Client to interact with the API
     * @param AuthenticationAdapter $authAdapter Auth to use
     * @param LoggerInterface|null $logger Defaults to NullLogger
     */
    public function __construct(
        \GuzzleHttp\Client $guzzleClient,
        AuthenticationAdapter $authAdapter,
        LoggerInterface $logger = null
    ) {
        $this->authAdapter  = $authAdapter;
        $this->guzzleClient = $guzzleClient;
        $this->logger       = $logger ?? new NullLogger();

        $this->logger->info('Authenticating with Glimesh using ' . get_class($authAdapter));

        $this->authAdapter->authenticate($guzzleClient);
    }

    /**
     * Make a request to the API using GraphQL, will return a complex object structure
     * based on the return value
     *
     * @param \GraphQL\Query $query
     *
     * @return object
     */
    public function makeRequest(\GraphQL\Query $query): object
    {
        $data = $this->makeRawRequest($query);

        $key = reset(array_keys($data));

        return self::getObject($key, $data[$key]);
    }

    /**
     * Make a request to the API using GraphQL, will return a simple, unmodified array
     *
     * @param \GraphQL\Query $query
     *
     * @return array
     */
    public function makeRawRequest(\GraphQL\Query $query): array
    {
        $req = $this->guzzleClient->request(
            'GET',
            self::GlimUrl . '/api',
            [
                'body' => self::getQueryString($query),
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

    /**
     * Get a multiline error string from an error array item returned from the API
     *
     * @param array $glimeshError
     *
     * @return string
     */
    private static function getAllErrorStrings(array $glimeshErrors): string
    {
        return implode("\n", (array_map(function(array $error) {
            return self::getErrorString($error);
        }, $glimeshErrors ?? [])));
    }

    /**
     * Get an error string from an error array item returned from the API
     *
     * @param array $glimeshError
     *
     * @return string
     */
    private static function getErrorString(array $glimeshError): string
    {
        return sprintf(
            "Glimesh API Error, Col %s Line %s: %s",
            $glimeshError['locations'][0]['column'],
            $glimeshError['locations'][0]['line'],
            $glimeshError['message'],
        );
    }

    /**
     * Returns a query in a pretty printed form
     *
     * @param string $string
     *
     * @return string
     */
    public static function prettyPrintQuery(string $string): string
    {
        $lines = explode("\n", $string);
        $t = "    ";
        $ct = 0;
        foreach ($lines as $index => $line) {
            if (substr($line, -1, 1) === '{') {
                $ct += 1;
            } elseif (substr($line, -1, 1) === '}') {
                $ct -= 1;
            }

            $lines[$index] = str_repeat($t, $ct) . $lines[$index];
        }

        return implode("\n", $lines) . "\n";
    }

    /**
     * Get the query string, converting anything that needs to be converted
     *
     * @param \GraphQL\Query $query
     *
     * @return string
     */
    public static function getQueryString(\GraphQL\Query $query): string
    {
        $queryString = $query->__toString();
        $queryString = preg_replace('/\"ENUM:(.*?)\"/', '$1', $queryString);

        return $queryString;
    }
}
