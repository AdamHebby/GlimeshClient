<?php

namespace GlimeshClient;

use GlimeshClient\Adapters\Authentication\AuthenticationAdapter;
use GlimeshClient\Objects\AbstractObjectModel;
use GlimeshClient\Traits\ObjectResolverTrait;
use phpDocumentor\Reflection\Types\AbstractList;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client
{
    use ObjectResolverTrait;

    public const GlimUrl = 'https://glimesh.tv';

    private $authAdapter = null;
    private $guzzleClient = null;
    private $logger = null;

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

    public function makeRequest(\GraphQL\Query $query): object
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

        $key = array_keys($data['data'])[0];
        return self::getObject($key, $data['data'][$key]);
    }

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

        return json_decode($req->getBody()->getContents(), true);
    }

    /**
     * Returns a query in a pretty printed form
     *
     * @param string $string
     * @return string
     */
    public static function prettyPrintQuery(string $string)
    {
        $lines = explode("\n", $string);
        $t = "    ";
        $ct = 0;
        foreach ($lines as $index => $line) {
            if (substr($line, -1, 1) === '{') {
                $lines[$index] = str_repeat($t, $ct) . $lines[$index];
                $ct += 1;
            } else if (substr($line, -1, 1) === '}') {
                $ct -= 1;
                $lines[$index] = str_repeat($t, $ct) . $lines[$index];
            } else {
                $lines[$index] = str_repeat($t, $ct) . $lines[$index];
            }
        }

        return implode("\n", $lines) . "\n";
    }

    /**
     * Get the query string, converting anything that needs to be converted
     *
     * @param \GraphQL\Query $query
     * @return string
     */
    public static function getQueryString(\GraphQL\Query $query): string
    {
        $queryString = $query->__toString();
        $queryString = preg_replace('/\"ENUM:(.*?)\"/', '$1', $queryString);

        return $queryString;
    }
}
