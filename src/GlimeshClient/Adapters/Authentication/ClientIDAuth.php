<?php

namespace GlimeshClient\Adapters\Authentication;

/**
 * Client ID only
 */
final class ClientIDAuth implements AuthenticationAdapter
{
    private $clientId = null;

    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    public function getAuthentication(): ?string
    {
        if (!isset($this->clientId)) return null;

        return 'Client-ID ' . $this->clientId;
    }

    public function authenticate(\GuzzleHttp\Client $client): void
    {
        return;
    }
}
