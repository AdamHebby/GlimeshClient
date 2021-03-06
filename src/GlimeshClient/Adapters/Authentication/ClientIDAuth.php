<?php

namespace GlimeshClient\Adapters\Authentication;

/**
 * Client ID only
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
final class ClientIDAuth implements AuthenticationAdapter
{
    /**
     * Client ID Auth Constructor, not much to it
     *
     * @param string $clientId
     */
    public function __construct(private readonly string $clientId)
    {
    }

    /**
     * @inheritDoc
     */
    public function isExpired(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getAuthentication(): ?string
    {
        return 'Client-ID ' . $this->clientId;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(\GuzzleHttp\Client $client): void
    {
        return;
    }
}
