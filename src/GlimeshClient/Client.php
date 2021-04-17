<?php

namespace GlimeshClient;

use GlimeshClient\Adapters\Authentication\AuthenticationAdapter;
use GlimeshClient\Traits\ObjectResolverTrait;
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

        $authRes = $this->authAdapter->authenticate($guzzleClient);

        $this->logger->info('Authenticating returned ' . $authRes);
    }
}
